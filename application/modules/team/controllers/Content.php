<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Content controller
 */
class Content extends Admin_Controller
{
    protected $permissionCreate = 'Team.Content.Create';
    protected $permissionDelete = 'Team.Content.Delete';
    protected $permissionEdit   = 'Team.Content.Edit';
    protected $permissionView   = 'Team.Content.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('team/team_model');
        $this->lang->load('team');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
            $this->form_validation->set_error_delimiters("<span class='error'>", "</span>");
        
        Template::set_block('sub_nav', 'content/_sub_nav');

        Assets::add_module_js('team', 'team.js');
    }

    /**
     * Display a list of Team data.
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
                    $deleted = $this->team_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('team_delete_success'), 'success');
                } else {
                    Template::set_message(lang('team_delete_failure') . $this->team_model->error, 'error');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/content/team/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->team_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->team_model->limit($limit, $offset);
        
        $profile_id = NULL;
        $profile_id = $this->session->userdata('profile_id');
        $records = $this->team_model->find_all($profile_id);

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('team_manage'));

        Template::render();
    }
    
    /**
     * Create a Team object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_team()) {
                log_activity($this->auth->user_id(), lang('team_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'team');
                Template::set_message(lang('team_create_success'), 'success');

                redirect(SITE_AREA . '/content/team');
            }

            // Not validation error
            if ( ! empty($this->team_model->error)) {
                Template::set_message(lang('team_create_failure') . $this->team_model->error, 'error');
            }
        }

        Template::set('toolbar_title', lang('team_action_create'));

        Template::render();
    }
    /**
     * Allows editing of Team data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('team_invalid_id'), 'error');

            redirect(SITE_AREA . '/content/team');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_team('update', $id)) {
                log_activity($this->auth->user_id(), lang('team_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'team');
                Template::set_message(lang('team_edit_success'), 'success');
                redirect(SITE_AREA . '/content/team');
            }

            // Not validation error
            if ( ! empty($this->team_model->error)) {
                Template::set_message(lang('team_edit_failure') . $this->team_model->error, 'error');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->team_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('team_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'team');
                Template::set_message(lang('team_delete_success'), 'success');

                redirect(SITE_AREA . '/content/team');
            }

            Template::set_message(lang('team_delete_failure') . $this->team_model->error, 'error');
        }
        
        Template::set('team', $this->team_model->find($id));

        Template::set('toolbar_title', lang('team_edit_heading'));
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
    private function save_team($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->team_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->team_model->prep_data($this->input->post());

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
        $data['profile_id'] = $this->session->userdata('profile_id');

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
		$data['dob']	= $this->input->post('dob') ? $this->input->post('dob') : '0000-00-00';
		$data['date_of_issue']	= $this->input->post('date_of_issue') ? $this->input->post('date_of_issue') : '0000-00-00';
		$data['date_of_expiry']	= $this->input->post('date_of_expiry') ? $this->input->post('date_of_expiry') : '0000-00-00';

        $return = false;
        if ($type == 'insert') {
            $id = $this->team_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->team_model->update($id, $data);
        }

        return $return;
    }
}