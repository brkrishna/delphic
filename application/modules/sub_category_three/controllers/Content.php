<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Sub_category_three.Content.Create';
    protected $permissionDelete = 'Sub_category_three.Content.Delete';
    protected $permissionEdit   = 'Sub_category_three.Content.Edit';
    protected $permissionView   = 'Sub_category_three.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('sub_category_three/sub_category_three_model');
        $this->lang->load('sub_category_three');
        
            Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce.js'));
            Assets::add_js(Template::theme_url('js/editors/tiny_mce/tiny_mce_init.js'));
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('sub_category_three', 'sub_category_three.js');
    }

    /**
     * Display a list of Sub Category Three data.
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
                    $deleted = $this->sub_category_three_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('sub_category_three_delete_success'), 'success');
                } else {
                    Template::set_message(lang('sub_category_three_delete_failure') . $this->sub_category_three_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/sub_category_three/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->sub_category_three_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->sub_category_three_model->limit($limit, $offset);
        
        $records = $this->sub_category_three_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('sub_category_three_manage'));

        Template::render();
    }
    
    /**
     * Create a Sub Category Three object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_sub_category_three()) {
                log_activity($this->auth->user_id(), lang('sub_category_three_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'sub_category_three');
                Template::set_message(lang('sub_category_three_create_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category_three');
            }

            // Not validation error
            if ( ! empty($this->sub_category_three_model->error)) {
                Template::set_message(lang('sub_category_three_create_failure') . $this->sub_category_three_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('sub_category_three_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Sub Category Three data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('sub_category_three_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/sub_category_three');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_sub_category_three('update', $id)) {
                log_activity($this->auth->user_id(), lang('sub_category_three_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category_three');
                Template::set_message(lang('sub_category_three_edit_success'), 'success');
                redirect(SITE_AREA . '/content/sub_category_three');
            }

            // Not validation error
            if ( ! empty($this->sub_category_three_model->error)) {
                Template::set_message(lang('sub_category_three_edit_failure') . $this->sub_category_three_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->sub_category_three_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('sub_category_three_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'sub_category_three');
                Template::set_message(lang('sub_category_three_delete_success'), 'success');

                redirect(SITE_AREA . '/content/sub_category_three');
            }

            Template::set_message(lang('sub_category_three_delete_failure') . $this->sub_category_three_model->error, 'error');
        }
        
        Template::set('sub_category_three', $this->sub_category_three_model->find($id));

        Template::set('toolbar_title', lang('sub_category_three_edit_heading'));
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
    private function save_sub_category_three($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->sub_category_three_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->sub_category_three_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->sub_category_three_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->sub_category_three_model->update($id, $data);
        }

        return $return;
    }
}