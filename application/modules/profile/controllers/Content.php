<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Profile.Content.Create';
    protected $permissionDelete = 'Profile.Content.Delete';
    protected $permissionEdit   = 'Profile.Content.Edit';
    protected $permissionView   = 'Profile.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model(array('profile/profile_model', 'profile_users/profile_users_model'));
        $this->load->model('countries_model');
        $this->lang->load('profile');
        
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");
            
        Template::set_block('sub_nav', 'content/_sub_nav');
        Assets::add_module_js('profile', 'profile.js');
        
		$countries_select = $this->countries_model->get_countries_select();
		Template::set('countries_select', $countries_select);

    }

    /**
     * Display a list of Profile data.
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
                    $deleted = $this->profile_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('profile_delete_success'), 'success');
                } else {
                    Template::set_message(lang('profile_delete_failure') . $this->profile_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/profile/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->profile_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->profile_model->limit($limit, $offset);
        
        $profile_id = NULL;
        if (null != $this->session->userdata('profile_id') && $this->current_user->role_id == 7)
        {
            $profile_id = $this->session->userdata('profile_id');
        }
        $records = $this->profile_model->find_all($profile_id);

        Template::set('records', $records);
        Template::set('toolbar_title', lang('profile_manage'));

        Template::render();
    }
    
    /**
     * Create a Profile object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_profile()) {
                log_activity($this->auth->user_id(), lang('profile_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'profile');
                Template::set_message(lang('profile_create_success'), 'success');

                redirect(SITE_AREA . '/content/profile/edit/' . $insert_id);    
            }

            // Not validation error
            if ( ! empty($this->profile_model->error)) {
                Template::set_message(lang('profile_create_failure') . $this->profile_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('profile_action_create'));
        Template::set_view('content/edit');    
        Template::render();
    }
    /**
     * Allows editing of Profile data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('profile_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/profile/edit/' . $id);
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_profile('update', $id)) {
                log_activity($this->auth->user_id(), lang('profile_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'profile');
                Template::set_message(lang('profile_edit_success'), 'success');
                //redirect(SITE_AREA . '/content/profile');
            }

            // Not validation error
            if ( ! empty($this->profile_model->error)) {
                Template::set_message(lang('profile_edit_failure') . $this->profile_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->profile_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('profile_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'profile');
                Template::set_message(lang('profile_delete_success'), 'success');

                redirect(SITE_AREA . '/content/profile');
            }

            Template::set_message(lang('profile_delete_failure') . $this->profile_model->error, 'error');
        }
        
        Template::set('profile', $this->profile_model->find($id));

        Template::set('toolbar_title', lang('profile_edit_heading'));
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

    public function phone_regex($input_val){
        if(preg_match('/^[0-9]{10,14}$/', $input_val)){
            return true;
        }else{
            return false;
        }
    }

    private function save_profile($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->profile_model->get_validation_rules());
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'callback_phone_regex');
        $this->form_validation->set_rules('alt_contact_number', 'Alternate Contact Number', 'callback_phone_regex');
        
        if ($this->form_validation->run($this) === false) {
            return false;
        }


		// make sure we only pass in the fields we want
        $data = $this->profile_model->prep_data($this->input->post());

		if (isset($_FILES['image']) && is_array($_FILES['image']) && $_FILES['image']['error'] != 4)
        {
			// make sure we only pass in the fields we want
			$file_path = $this->config->item('upload_dir');
			$config['upload_path']		= $file_path;
			$config['allowed_types']	= 'pdf|jpg|gif|png';

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('image'))
			{
				return array('error'=>$this->upload->display_errors());
			}else{
				$data['image'] = serialize($this->upload->data());			
			}		
        }else{
            unset($data['image']);
        }
        
        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
    
        $return = false;
        if ($type == 'insert') {
            $id = $this->profile_model->insert($data);

            if (is_numeric($id)) {
                $profile_user = array();
                $profile_user['profile_id'] = $id;
                $profile_user['user_id'] = $this->current_user->id;
                $this->profile_users_model->insert($profile_user);
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->profile_model->update($id, $data);
        }

        return $return;
    }
}