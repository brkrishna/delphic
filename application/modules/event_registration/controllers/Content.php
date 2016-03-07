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
        $this->load->model(array('category/category_model', 'style/style_model', 'performance/performance_model'));
        $this->lang->load('event_registration');
        $this->load->model('team/team_model');

        $categories_select = $this->category_model->get_category_select();
        Template::set('categories_select', $categories_select);
        
        $style_select = $this->style_model->get_style_select();
        Template::set('style_select', $style_select);
        
        $performance_select = $this->performance_model->get_performance_select();
        Template::set('performance_select', $performance_select);

        $teams_select = $this->team_model->get_teams_select();
        Template::set('teams_select', $teams_select);
        
        $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('event_registration', 'event_registration.js');
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
        
        $records = $this->event_registration_model->find_all();

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

        $data = $this->event_registration_model->prep_data($this->input->post());
        $data['team'] = serialize($this->input->post('team'));
         $data['profile'] = $this->session->userdata('profile_id');
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        if (isset($_FILES['attach_1']) && is_array($_FILES['attach_1']) && $_FILES['attach_1']['error'] != 4)
        {
            // make sure we only pass in the fields we want
            $file_path = $this->config->item('upload_dir');
            $config['upload_path']      = $file_path;
            $config['allowed_types']    = 'pdf|jpg|gif|png';

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('attach_1'))
            {
                return array('error'=>$this->upload->display_errors());
            }else{
                $data['attach_1'] = serialize($this->upload->data());         
            }       
        }else{
            unset($data['attach_1']);
        }

        unset($data['attach_2']);
        unset($data['attach_3']);
        unset($data['attach_4']);
        unset($data['attach_5']);

        // Validate the data
        $this->form_validation->set_rules($this->event_registration_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

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