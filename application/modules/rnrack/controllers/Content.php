<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Rnrack.Content.Create';
    protected $permissionDelete = 'Rnrack.Content.Delete';
    protected $permissionEdit   = 'Rnrack.Content.Edit';
    protected $permissionView   = 'Rnrack.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('rnrack/rnrack_model');
        $this->lang->load('rnrack');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('rnrack', 'rnrack.js');
    }

    /**
     * Display a list of rnrack data.
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
                    $deleted = $this->rnrack_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('rnrack_delete_success'), 'success');
                } else {
                    Template::set_message(lang('rnrack_delete_failure') . $this->rnrack_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/rnrack/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->rnrack_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->rnrack_model->limit($limit, $offset);
        
        $records = $this->rnrack_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('rnrack_manage'));

        Template::render();
    }
    
    /**
     * Create a rnrack object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_rnrack()) {
                log_activity($this->auth->user_id(), lang('rnrack_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'rnrack');
                Template::set_message(lang('rnrack_create_success'), 'success');

                redirect(SITE_AREA . '/content/rnrack');
            }

            // Not validation error
            if ( ! empty($this->rnrack_model->error)) {
                Template::set_message(lang('rnrack_create_failure') . $this->rnrack_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('rnrack_action_create'));

        Template::render();
    }
    /**
     * Allows editing of rnrack data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('rnrack_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/rnrack');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_rnrack('update', $id)) {
                log_activity($this->auth->user_id(), lang('rnrack_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'rnrack');
                Template::set_message(lang('rnrack_edit_success'), 'success');
                redirect(SITE_AREA . '/content/rnrack');
            }

            // Not validation error
            if ( ! empty($this->rnrack_model->error)) {
                Template::set_message(lang('rnrack_edit_failure') . $this->rnrack_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->rnrack_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('rnrack_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'rnrack');
                Template::set_message(lang('rnrack_delete_success'), 'success');

                redirect(SITE_AREA . '/content/rnrack');
            }

            Template::set_message(lang('rnrack_delete_failure') . $this->rnrack_model->error, 'error');
        }
        
        Template::set('rnrack', $this->rnrack_model->find($id));

        Template::set('toolbar_title', lang('rnrack_edit_heading'));
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
    private function save_rnrack($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->rnrack_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->rnrack_model->prep_data($this->input->post());
        $data['profile'] = $this->session->userdata('profile_id');
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->rnrack_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->rnrack_model->update($id, $data);
        }

        return $return;
    }
}