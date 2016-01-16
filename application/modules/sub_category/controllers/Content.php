<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Sub_category.Content.Create';
    protected $permissionDelete = 'Sub_category.Content.Delete';
    protected $permissionEdit   = 'Sub_category.Content.Edit';
    protected $permissionView   = 'Sub_category.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('sub_category/sub_category_model');
        $this->lang->load('sub_category');
        
            Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce.js'));
            Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce_init.js'));
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('sub_category', 'sub_category.js');
    }

    /**
     * Display a list of Sub Category data.
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
                    $deleted = $this->sub_category_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_delete_success'), 'success');
                } else {
                    Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/sub_category/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->sub_category_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->sub_category_model->limit($limit, $offset);
        
        $records = $this->sub_category_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('sub_category_manage'));

        Template::render();
    }
    
    /**
     * Create a Sub Category object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_sub_category()) {
                log_activity($this->auth->user_id(), lang('sub_category_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category');
                Template::set_message(lang('sub_category_create_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category');
            }

            // Not validation error
            if ( ! empty($this->sub_category_model->error)) {
                Template::set_message(lang('sub_category_create_failure') . $this->sub_category_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('sub_category_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Sub Category data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('sub_category_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/sub_category');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_sub_category('update', $id)) {
                log_activity($this->auth->user_id(), lang('sub_category_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');
                Template::set_message(lang('sub_category_edit_success'), 'success');
                redirect(SITE_AREA . '/content/sub_category');
            }

            // Not validation error
            if ( ! empty($this->sub_category_model->error)) {
                Template::set_message(lang('sub_category_edit_failure') . $this->sub_category_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->sub_category_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('sub_category_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category');
                Template::set_message(lang('sub_category_delete_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category');
            }

            Template::set_message(lang('sub_category_delete_failure') . $this->sub_category_model->error, 'error');
        }
        
        Template::set('sub_category', $this->sub_category_model->find($id));

        Template::set('toolbar_title', lang('sub_category_edit_heading'));
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
    private function save_sub_category($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->sub_category_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->sub_category_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->sub_category_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->sub_category_model->update($id, $data);
        }

        return $return;
    }
}