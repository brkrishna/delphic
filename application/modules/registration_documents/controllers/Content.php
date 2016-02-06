<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Registration_documents.Content.Create';
    protected $permissionDelete = 'Registration_documents.Content.Delete';
    protected $permissionEdit   = 'Registration_documents.Content.Edit';
    protected $permissionView   = 'Registration_documents.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model(array('registration_documents/registration_documents_model', 'registration/registration_model'));
        $this->lang->load('registration_documents');
        
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('registration_documents', 'registration_documents.js');
    }

    /**
     * Display a list of Registration Documents data.
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
                    $deleted = $this->registration_documents_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('registration_documents_delete_success'), 'success');
                } else {
                    Template::set_message(lang('registration_documents_delete_failure') . $this->registration_documents_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/registration_documents/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->registration_documents_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->registration_documents_model->limit($limit, $offset);
        
        $records = $this->registration_documents_model->find_all();

        Template::set('records', $records);
        
        Template::set('toolbar_title', lang('registration_documents_manage'));

        Template::render();
    }
    
    /**
     * Create a Registration Documents object.
     *
     * @return void
     */
    public function create($registration_nbr = 0)
    {
        $this->auth->restrict($this->permissionCreate);
        
        if($registration_nbr < 0){
            Template::set_message(lang('registration_documents_create_failure') . $this->registration_documents_model->error, 'error');
        }
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_registration_documents()) {
                log_activity($this->auth->user_id(), lang('registration_documents_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'registration_documents');
                Template::set_message(lang('registration_documents_create_success'), 'success');

                redirect(SITE_AREA . '/content/registration_documents/create/' . $registration_nbr);
            }

            // Not validation error
            if ( ! empty($this->registration_documents_model->error)) {
                Template::set_message(lang('registration_documents_create_failure') . $this->registration_documents_model->error, 'error');
            }
        }

        $this->load->model('registration/registration_model');
        Template::set('registration', $this->registration_model->find_regn_details($registration_nbr));

        Template::set('registration_nbr', $registration_nbr);
        Template::set('records', $this->registration_documents_model->find_all($registration_nbr));
        Template::set('toolbar_title', lang('registration_documents_action_create'));
        Template::render();
    }
    /**
     * Allows editing of Registration Documents data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('registration_documents_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/registration_documents');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_registration_documents('update', $id)) {
                log_activity($this->auth->user_id(), lang('registration_documents_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration_documents');
                Template::set_message(lang('registration_documents_edit_success'), 'success');
                redirect(SITE_AREA . '/content/registration_documents/create/' . $registration_nbr);
            }

            // Not validation error
            if ( ! empty($this->registration_documents_model->error)) {
                Template::set_message(lang('registration_documents_edit_failure') . $this->registration_documents_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->registration_documents_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('registration_documents_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'registration_documents');
                Template::set_message(lang('registration_documents_delete_success'), 'success');

                redirect(SITE_AREA . '/content/registration_documents');
            }

            Template::set_message(lang('registration_documents_delete_failure') . $this->registration_documents_model->error, 'error');
        }
        
        $documents = $this->registration_documents_model->find($id);
        
        $registration_nbr = $documents->registration;
        Template::set('registration', $this->registration_model->find_regn_details($registration_nbr));
        Template::set('registration_documents', $this->registration_documents_model->find($id));
        Template::set('records', $this->registration_documents_model->find_all($registration_nbr));
        Template::set('registration_nbr', $registration_nbr);

        Template::set('toolbar_title', lang('registration_documents_edit_heading'));
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
    private function save_registration_documents($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }


        // Make sure we only pass in the fields we want
        
        $data = $this->registration_documents_model->prep_data($this->input->post());
        $data['profile'] = $this->session->userdata('profile_id');
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
		if (isset($_FILES['attachment']) && is_array($_FILES['attachment']) && $_FILES['attachment']['error'] != 4)
        {
			// make sure we only pass in the fields we want
			$file_path = $this->config->item('upload_dir');
			$config['upload_path']		= $file_path;
			$config['allowed_types']	= 'pdf|jpg|gif|png';

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('attachment'))
			{
				return array('error'=>$this->upload->display_errors());
			}else{
				$data['attachment'] = serialize($this->upload->data());			
			}		
        }else{
            unset($data['attachment']);
        }
        
        // Validate the data
        $this->form_validation->set_rules($this->registration_documents_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        $return = false;
        if ($type == 'insert') {
            $id = $this->registration_documents_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->registration_documents_model->update($id, $data);
        }

        return $return;
    }
}   
 