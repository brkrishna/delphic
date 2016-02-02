<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Event.Content.Create';
    protected $permissionDelete = 'Event.Content.Delete';
    protected $permissionEdit   = 'Event.Content.Edit';
    protected $permissionView   = 'Event.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('event/event_model');
        $this->load->model(array('category/category_model', 'style/style_model', 'performance/performance_model'));
        $this->lang->load('event');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('event', 'event.js');
        
		$categories_select = $this->category_model->get_category_select();
		Template::set('categories_select', $categories_select);
        
		$style_select = $this->style_model->get_style_select();
		Template::set('style_select', $style_select);
        
		$performance_select = $this->performance_model->get_performance_select();
		Template::set('performance_select', $performance_select);
        
    }

    /**
     * Display a list of Event data.
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
                    $deleted = $this->event_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('event_delete_success'), 'success');
                } else {
                    Template::set_message(lang('event_delete_failure') . $this->event_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/event/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->event_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->event_model->limit($limit, $offset);
        
        $records = $this->event_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('event_manage'));

        Template::render();
    }
    
    /**
     * Create a Event object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_event()) {
                log_activity($this->auth->user_id(), lang('event_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'event');
                Template::set_message(lang('event_create_success'), 'success');

                redirect(SITE_AREA . '/content/event');
            }

            // Not validation error
            if ( ! empty($this->event_model->error)) {
                Template::set_message(lang('event_create_failure') . $this->event_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('event_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Event data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('event_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/event');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_event('update', $id)) {
                log_activity($this->auth->user_id(), lang('event_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'event');
                Template::set_message(lang('event_edit_success'), 'success');
                redirect(SITE_AREA . '/content/event');
            }

            // Not validation error
            if ( ! empty($this->event_model->error)) {
                Template::set_message(lang('event_edit_failure') . $this->event_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->event_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('event_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'event');
                Template::set_message(lang('event_delete_success'), 'success');

                redirect(SITE_AREA . '/content/event');
            }

            Template::set_message(lang('event_delete_failure') . $this->event_model->error, 'error');
        }
        
        Template::set('event', $this->event_model->find($id));

        Template::set('toolbar_title', lang('event_edit_heading'));
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
    private function save_event($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->event_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->event_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->event_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->event_model->update($id, $data);
        }

        return $return;
    }
}