<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Sub_category_two.Content.Create';
    protected $permissionDelete = 'Sub_category_two.Content.Delete';
    protected $permissionEdit   = 'Sub_category_two.Content.Edit';
    protected $permissionView   = 'Sub_category_two.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('sub_category_two/sub_category_two_model');
        $this->lang->load('sub_category_two');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('sub_category_two', 'sub_category_two.js');
    }

    /**
     * Display a list of Sub Category Two data.
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
                    $deleted = $this->sub_category_two_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_two_delete_success'), 'success');
                } else {
                    Template::set_message(lang('sub_category_two_delete_failure') . $this->sub_category_two_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/sub_category_two/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->sub_category_two_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->sub_category_two_model->limit($limit, $offset);
        
        $records = $this->sub_category_two_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('sub_category_two_manage'));

        Template::render();
    }
    
    /**
     * Create a Sub Category Two object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_sub_category_two()) {
                log_activity($this->auth->user_id(), lang('sub_category_two_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category_two');
                Template::set_message(lang('sub_category_two_create_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category_two');
            }

            // Not validation error
            if ( ! empty($this->sub_category_two_model->error)) {
                Template::set_message(lang('sub_category_two_create_failure') . $this->sub_category_two_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('sub_category_two_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Sub Category Two data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('sub_category_two_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/sub_category_two');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_sub_category_two('update', $id)) {
                log_activity($this->auth->user_id(), lang('sub_category_two_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category_two');
                Template::set_message(lang('sub_category_two_edit_success'), 'success');
                redirect(SITE_AREA . '/content/sub_category_two');
            }

            // Not validation error
            if ( ! empty($this->sub_category_two_model->error)) {
                Template::set_message(lang('sub_category_two_edit_failure') . $this->sub_category_two_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->sub_category_two_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('sub_category_two_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category_two');
                Template::set_message(lang('sub_category_two_delete_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category_two');
            }

            Template::set_message(lang('sub_category_two_delete_failure') . $this->sub_category_two_model->error, 'error');
        }
        
        Template::set('sub_category_two', $this->sub_category_two_model->find($id));

        Template::set('toolbar_title', lang('sub_category_two_edit_heading'));
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
    private function save_sub_category_two($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->sub_category_two_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->sub_category_two_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->sub_category_two_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->sub_category_two_model->update($id, $data);
        }

        return $return;
    }
}