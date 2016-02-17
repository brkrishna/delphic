<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Registration_team.Content.Create';
    protected $permissionDelete = 'Registration_team.Content.Delete';
    protected $permissionEdit   = 'Registration_team.Content.Edit';
    protected $permissionView   = 'Registration_team.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('registration_team/registration_team_model');
        $this->load->model('team/team_model');
        $this->lang->load('registration_team');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('registration_team', 'registration_team.js');
        
		$teams_select = $this->team_model->get_teams_select();
		Template::set('teams_select', $teams_select);
        
    }

    /**
     * Display a list of Registration Team data.
     *
     * @return void
     */
    public function index($offset = 0)
    {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

                $result = true;
                foreach ($checked as $pid) {
                    $deleted = $this->registration_team_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('registration_team_delete_success'), 'success');
                } else {
                    Template::set_message(lang('registration_team_delete_failure') . $this->registration_team_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/registration_team/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->registration_team_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->registration_team_model->limit($limit, $offset);
        
        $records = $this->registration_team_model->find_all();

        Template::set('records', $records);
        
        Template::set('toolbar_title', lang('registration_team_manage'));

        Template::render();
    }
    
    /**
     * Create a Registration Team object.
     *
     * @return void
     */
    public function create($registration_nbr = 0)
    {
        $this->auth->restrict($this->permissionCreate);

        $id = $this->uri->segment(5);

        //var_dump($_POST['registration']);
        //exit;

        if($registration_nbr < 0){
            Template::set_message(lang('registration_team_create_failure') . $this->registration_team_model->error, 'error');
        }
        
        if (isset($_POST['save'])) {
            $this->registration_team_model->where(array('registration'=>$_POST['registration'], 'team'=>$_POST['team'], 'deleted'=>'0'));
            $result = $this->db->get('registration_team');
            if ($result->num_rows() > 0){
                Template::set_message('Duplicate. This team member is already added to the event', 'error');
            }else{
                if ($insert_id = $this->save_registration_team()) {
                    log_activity($this->auth->user_id(), lang('registration_team_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'registration_team');
                    Template::set_message(lang('registration_team_create_success'), 'success');
    
                    redirect(SITE_AREA . '/content/registration_team/create/' . $registration_nbr);
                }
    
                // Not validation error
                if ( ! empty($this->registration_team_model->error)) {
                    Template::set_message(lang('registration_team_create_failure') . $this->registration_team_model->error, 'error');
                }
            }
        }elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->registration_team_model->delete($id)) {
                echo('deleted' . $id);
                log_activity($this->auth->user_id(), lang('registration_team_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration_team');
                Template::set_message(lang('registration_team_delete_success'), 'success');

                redirect(SITE_AREA . '/content/registration_team/edit/' . $_POST['registration']);;
            }

            Template::set_message(lang('registration_team_delete_failure') . $this->registration_team_model->error, 'error');
        }
        
        $this->load->model('registration/registration_model');
        Template::set('registration', $this->registration_model->find_regn_details($registration_nbr));
        Template::set('registration_nbr', $registration_nbr);
        Template::set('toolbar_title', lang('registration_team_action_create'));
        $records = $this->registration_team_model->find_regn_team($registration_nbr);
        Template::set('records', $records);

        Template::render();
    }
    /**
     * Allows editing of Registration Team data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('registration_team_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/registration_team');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_registration_team('update', $id)) {
                log_activity($this->auth->user_id(), lang('registration_team_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration_team');
                Template::set_message(lang('registration_team_edit_success'), 'success');
                redirect(SITE_AREA . '/content/registration_team/create/' . $_POST['registration']);
            }

            // Not validation error
            if ( ! empty($this->registration_team_model->error)) {
                Template::set_message(lang('registration_team_edit_failure') . $this->registration_team_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            var_dump( $this->uri->segment(5));
            exit;
            $this->auth->restrict($this->permissionDelete);

            if ($this->registration_team_model->delete($id)) {
                echo('deleted' . $id);
                log_activity($this->auth->user_id(), lang('registration_team_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration_team');
                Template::set_message(lang('registration_team_delete_success'), 'success');

                redirect(SITE_AREA . '/content/registration_team/edit/' . $_POST['registration']);;
            }

            Template::set_message(lang('registration_team_delete_failure') . $this->registration_team_model->error, 'error');
        }
        
        $team = $this->registration_team_model->find($id);
        
        $registration_nbr = $team->registration;
        $this->load->model('registration/registration_model');
        
        Template::set('registration', $this->registration_model->find_regn_details($registration_nbr));
        Template::set('registration_nbr', $registration_nbr);
        
        Template::set('registration_team', $team);

        Template::set('toolbar_title', lang('registration_team_edit_heading'));
        
        $records = $this->registration_team_model->find_regn_team($registration_nbr);
        Template::set('records', $records);
        
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    private function save_registration_team($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->registration_team_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->registration_team_model->prep_data($this->input->post());
        $data['profile'] = $this->session->userdata('profile_id');
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->registration_team_model->insert($data);
            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->registration_team_model->update($id, $data);
        }

        return $return;
    }
}