<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Signup controller
 */
class Signup extends Front_Controller
{
    protected $permissionCreate = 'Signup.Signup.Create';
    protected $permissionDelete = 'Signup.Signup.Delete';
    protected $permissionEdit   = 'Signup.Signup.Edit';
    protected $permissionView   = 'Signup.Signup.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation'));
        $this->load->helper(array('form', 'url'));
        
        $this->load->model('signup/signup_model');
        $this->lang->load('signup');
        
            Assets::add_css('flick/jquery-ui-1.8.13.custom.css');
            Assets::add_js('jquery-ui-1.8.13.min.js');
        

        Assets::add_module_js('signup', 'signup.js');

        $this->load->model('countries_model');
        $countries_select = $this->countries_model->get_countries_select();
        Template::set('countries_select', $countries_select);

        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>", "</div>");

    }

    /**
     * Display a list of Signup data.
     *
     * @return void
     */
    public function index($offset = 0)
    {
        
        $pagerUriSegment = 3;
        $pagerBaseUrl = site_url('signup/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->signup_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->signup_model->limit($limit, $offset);
        

        // Don't display soft-deleted records
        $this->signup_model->where($this->signup_model->get_deleted_field(), 0);
        $records = $this->signup_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
    public function register(){
        // Are users allowed to register?
        if (! $this->settings_lib->item('auth.allow_register')) {
            Template::set_message(lang('us_register_disabled'), 'error');
            Template::redirect('/');
        }

        if (isset($_POST['save'])) {
            $this->load()
            if ($insert_id = $this->save_signup()) {
                Template::set_message(lang('signup_create_success'), 'success');

                redirect(SITE_AREA . '/content/signup');
            }

            // Not validation error
            if ( ! empty($this->signup_model->error)) {
                Template::set_message(lang('signup_create_failure') . $this->signup_model->error, 'error');
            }
        }


        Template::render();

    }

    private function save_signup($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->signup_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->signup_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        
        $data['dob']    = $this->input->post('dob') ? $this->input->post('dob') : '0000-00-00';

        $return = false;
        if ($type == 'insert') {
            $id = $this->signup_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->signup_model->update($id, $data);
        }

        return $return;
    }    
}