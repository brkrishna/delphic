<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Profile controller
 */
class Profile extends Front_Controller
{
    protected $permissionCreate = 'Profile.Profile.Create';
    protected $permissionDelete = 'Profile.Profile.Delete';
    protected $permissionEdit   = 'Profile.Profile.Edit';
    protected $permissionView   = 'Profile.Profile.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model(array('profile/profile_model', 'profile_users/profile_users_model', 'team/team_model','event_registration/event_registration_model'));
        $this->lang->load('profile');
        $this->load->library('session');
        
            Assets::add_js('//cdn.tinymce.com/4/tinymce.min.js');
            Assets::add_js(Template::theme_url('js/editors/tiny_mce_init.js'));
        

        Assets::add_module_js('profile', 'profile.js');
    }

    /**
     * Display a list of Profile data.
     *
     * @return void
     */
    public function index($offset = 0)
    {
        
        $pagerUriSegment = 3;
        $pagerBaseUrl = site_url('profile/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->profile_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->profile_model->limit($limit, $offset);
        

        // Don't display soft-deleted records
        $this->profile_model->where($this->profile_model->get_deleted_field(), 0);
        $records = $this->profile_model->find_all();

        Template::set('records', $records);
        

        Template::render();
    }
    
    public function profile_status()
    {
        $profile_id = NULL;
        if ($this->current_user->role_id == 7)
        {
            $profile_id = $this->profile_users_model->get_profile_id($this->current_user->id);    
            $profile_id = ($profile_id > 0 ? $profile_id : -1);
            $this->session->set_userdata('profile_id',$profile_id);
        }
        
        $data['current_user_role_id'] = $this->current_user->role_id;
        $data['profile_count'] = $this->profile_model->find_all($profile_id); 
        $data['team_count'] = $this->team_model->find_all($profile_id);
        $data['event_count'] = $this->event_registration_model->find_all($profile_id);
        return $this->load->view('/content/profile_status', $data);
    }

}