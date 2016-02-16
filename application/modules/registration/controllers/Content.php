<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Registration.Content.Create';
    protected $permissionDelete = 'Registration.Content.Delete';
    protected $permissionEdit   = 'Registration.Content.Edit';
    protected $permissionView   = 'Registration.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('registration/registration_model');
        $this->load->model(array('category/category_model', 'style/style_model', 'performance/performance_model'));
        $this->lang->load('registration');
        
        $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
            
        Template::set_block('sub_nav', 'content/_sub_nav');
        Assets::add_module_js('registration', 'registration.js');
        
		$categories_select = $this->category_model->get_category_select();
		Template::set('categories_select', $categories_select);
		
		$style_select = $this->style_model->get_style_select();
		Template::set('style_select', $style_select);
        
		$performance_select = $this->performance_model->get_performance_select();
		Template::set('performance_select', $performance_select);
    }
    
    public function get_category_styles($category){
        $this->load->model('event/event_model');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->event_model->get_category_styles($category)));
    }

    public function get_style_performances($style){
        $this->load->model('event/event_model');
        header('Content-Type: application/x-json; charset=utf-8');
        echo(json_encode($this->event_model->get_style_performances($style)));
    }

    /**
     * Display a list of Registration data.
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
                    $deleted = $this->registration_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('registration_delete_success'), 'success');
                } else {
                    Template::set_message(lang('registration_delete_failure') . $this->registration_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/registration/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->registration_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->registration_model->limit($limit, $offset);
        
        $profile_id = NULL;
        if (null != $this->session->userdata('profile_id') && $this->current_user->role_id == 7)
        {
            $profile_id = $this->session->userdata('profile_id');
        }
        
        //$records = $this->registration_model->find_all($profile_id);
        $records = $this->registration_model->find_regn_stats($profile_id);
        
        $this->load->model(array('registration_team/registration_team_model'));
        
        Template::set('records', $records);
        Template::set('toolbar_title', lang('registration_manage'));

        Template::render();
    }
    
    /**
     * Create a Registration object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save']) || isset($_POST['saveanother'])) {
            if ($insert_id = $this->save_registration()) {
                log_activity($this->auth->user_id(), lang('registration_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'registration');
                Template::set_message(lang('registration_create_success'), 'success');
                if(isset($_POST['save'])) {
                    redirect(SITE_AREA . '/content/registration/edit/' . $insert_id);    
                }else if(isset($_POST['saveanother'])){
                    redirect(SITE_AREA . '/content/registration/create');    
                }   
                
            }

            // Not validation error
            if ( ! empty($this->registration_model->error)) {
                Template::set_message(lang('registration_create_failure') . $this->registration_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('registration_action_create'));
        Template::set_view('content/edit');    
        Template::render();
    }
    /**
     * Allows editing of Registration data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('registration_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/registration/edit/' . $id);
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_registration('update', $id)) {
                log_activity($this->auth->user_id(), lang('registration_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration');
                Template::set_message(lang('registration_edit_success'), 'success');
                redirect(SITE_AREA . '/content/registration');
            }

            // Not validation error
            if ( ! empty($this->registration_model->error)) {
                Template::set_message(lang('registration_edit_failure') . $this->registration_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->registration_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('registration_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration');
                Template::set_message(lang('registration_delete_success'), 'success');

                redirect(SITE_AREA . '/content/registration');
            }

            Template::set_message(lang('registration_delete_failure') . $this->registration_model->error, 'error');
        }
        
        //$this->lang->load('registration_team/registration_team');
        Template::set('registration', $this->registration_model->find($id));

        Template::set('toolbar_title', lang('registration_edit_heading'));
        //Template::set_view('content/register');
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
    private function save_registration($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->registration_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->registration_model->prep_data($this->input->post());
        
        $data['profile_id'] = $this->session->userdata('profile_id');
        
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->registration_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->registration_model->update($id, $data);
        }

        return $return;
    }
    
    public function summary(){
        $this->load->model(array('profile/profile_model', 'registration_team/registration_team_model', 'registration_documents/registration_documents_model'));
        
        $profile_id = NULL;
        if (null != $this->session->userdata('profile_id') && $this->current_user->role_id == 7)
        {
            $profile_id = $this->session->userdata('profile_id');
        }
        
        $profile = $this->profile_model->find_all($profile_id);
        $registrations = $this->registration_model->find_regn_dtls($profile_id);
        
        Template::set('profile', $profile);
        Template::set('registrations', $registrations);
        Template::set('toolbar_title', lang('registration_manage'));

        Template::render();
    }

    public function register(){

        $id = $this->uri->segment(5);
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_registration('update', $id)) {
                log_activity($this->auth->user_id(), lang('registration_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration');
                Template::set_message(lang('registration_edit_success'), 'success');
                redirect(SITE_AREA . '/content/registration');
            }

            // Not validation error
            if ( ! empty($this->registration_model->error)) {
                Template::set_message(lang('registration_edit_failure') . $this->registration_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->registration_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('registration_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration');
                Template::set_message(lang('registration_delete_success'), 'success');

                redirect(SITE_AREA . '/content/registration');
            }

            Template::set_message(lang('registration_delete_failure') . $this->registration_model->error, 'error');
        }
        
        if(!empty($id)){
            Template::set('registration', $this->registration_model->find($id));    
        }
        
        $this->load->model(array('registration_team/registration_team_model'));
        if (!empty($registration_nbr)){
            $profile_team = $this->registration_team_model->find_regn_team($registration_nbr);    
        }else{
            $profile_team = NULL;
        }
        $this->lang->load('registration_team/registration_team');
        Template::set('profile_team', $profile_team);

        Template::set('toolbar_title', lang('registration_edit_heading'));
        Template::render();
    }
}