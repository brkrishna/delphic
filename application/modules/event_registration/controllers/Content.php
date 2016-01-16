<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Event_registration.Content.Create';
    protected $permissionDelete = 'Event_registration.Content.Delete';
    protected $permissionEdit   = 'Event_registration.Content.Edit';
    protected $permissionView   = 'Event_registration.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('event_registration/event_registration_model');
        $this->load->model(array('games/games_model', 'team/team_model'));
        $this->lang->load('event_registration');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('event_registration', 'event_registration.js');
        
		$games_select = $this->games_model->get_games_select();
		Template::set('games_select', $games_select);
        
		$games = $this->games_model->get_games();
		Template::set('games', $games);
        
        $profile_id = NULL;
        if ($this->current_user->role_id = 7){
            $profile_id = ($this->session->userdata('profile_id') > 0 ? $this->session->userdata('profile_id') : -1);
        }
        
		$teams_select = $this->team_model->get_teams_select($profile_id);
		Template::set('teams_select', $teams_select);
		
		$teams = $this->team_model->get_teams($profile_id);
		Template::set('teams', $teams);
    }

    /**
     * Display a list of Event Registration data.
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
                    $deleted = $this->event_registration_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('event_registration_delete_success'), 'success');
                } else {
                    Template::set_message(lang('event_registration_delete_failure') . $this->event_registration_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/event_registration/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->event_registration_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->event_registration_model->limit($limit, $offset);
        
        $profile_id = NULL;
        $profile_id = $this->session->userdata('profile_id');
        
        $records = $this->event_registration_model->find_all($profile_id);

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('event_registration_manage'));

        Template::render();
    }
    
    /**
     * Create a Event Registration object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_event_registration()) {
                log_activity($this->auth->user_id(), lang('event_registration_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'event_registration');
                Template::set_message(lang('event_registration_create_success'), 'success');

                redirect(SITE_AREA . '/content/event_registration');
            }

            // Not validation error
            if ( ! empty($this->event_registration_model->error)) {
                Template::set_message(lang('event_registration_create_failure') . $this->event_registration_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('event_registration_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Event Registration data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('event_registration_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/event_registration');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_event_registration('update', $id)) {
                log_activity($this->auth->user_id(), lang('event_registration_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'event_registration');
                Template::set_message(lang('event_registration_edit_success'), 'success');
                redirect(SITE_AREA . '/content/event_registration');
            }

            // Not validation error
            if ( ! empty($this->event_registration_model->error)) {
                Template::set_message(lang('event_registration_edit_failure') . $this->event_registration_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->event_registration_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('event_registration_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'event_registration');
                Template::set_message(lang('event_registration_delete_success'), 'success');

                redirect(SITE_AREA . '/content/event_registration');
            }

            Template::set_message(lang('event_registration_delete_failure') . $this->event_registration_model->error, 'error');
        }
        
        Template::set('event_registration', $this->event_registration_model->find($id));

        Template::set('toolbar_title', lang('event_registration_edit_heading'));
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
    private function save_event_registration($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->event_registration_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->event_registration_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        $data['profile_id'] = $this->session->userdata('profile_id');

        $return = false;
        if ($type == 'insert') {
            $id = $this->event_registration_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->event_registration_model->update($id, $data);
        }

        return $return;
    }
}