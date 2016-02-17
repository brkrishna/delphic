<?php defined('BASEPATH') || exit('No direct script access allowed');

class Registration_model extends BF_Model
{
    protected $table_name	= 'registration';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= true;
	protected $set_created	= true;
	protected $set_modified = true;
	protected $soft_deletes	= true;

	protected $created_field     = 'created_on';
    protected $created_by_field  = 'created_by';
	protected $modified_field    = 'modified_on';
    protected $modified_by_field = 'modified_by';
    protected $deleted_field     = 'deleted';
    protected $deleted_by_field  = 'deleted_by';

	// Customize the operations of the model without recreating the insert,
    // update, etc. methods by adding the method names to act as callbacks here.
	protected $before_insert 	= array();
	protected $after_insert 	= array();
	protected $before_update 	= array();
	protected $after_update 	= array();
	protected $before_find 	    = array();
	protected $after_find 		= array();
	protected $before_delete 	= array();
	protected $after_delete 	= array();

	// For performance reasons, you may require your model to NOT return the id
	// of the last inserted row as it is a bit of a slow method. This is
    // primarily helpful when running big loops over data.
	protected $return_insert_id = true;

	// The default type for returned row data.
	protected $return_type = 'object';

	// Items that are always removed from data prior to inserts or updates.
	protected $protected_attributes = array();

	// You may need to move certain rules (like required) into the
	// $insert_validation_rules array and out of the standard validation array.
	// That way it is only required during inserts, not updates which may only
	// be updating a portion of the data.
	protected $validation_rules 		= array(
		array(
			'field' => 'profile_id',
			'label' => 'lang:registration_field_profile_id',
			'rules' => '',
		),
		array(
			'field' => 'category',
			'label' => 'lang:registration_field_category',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'style',
			'label' => 'lang:registration_field_style',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'performance',
			'label' => 'lang:registration_field_performance',
			'rules' => 'required|is_natural',
		),
		array(
			'field' => 'comments',
			'label' => 'lang:registration_field_comments',
			'rules' => 'max_length[4000]',
		),
	);
	protected $insert_validation_rules  = array();
	protected $skip_validation 			= false;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function find_all($profile_id = NULL)
    {
        if ($profile_id != NULL)
        {
            $query = $this->db->get_where($this->table_name, array('profile_id'=>$profile_id, 'deleted'=>0));
        }
        else{
            $query = $this->db->get($this->table_name);
        }
        
		if (!$query->num_rows())
		{
			return FALSE;
		}else{
            return $query->result();
        }
    }
    
    public function find_regn_details($regn_id = -1){
        if ($regn_id < 0){
            return FALSE;
        }else{
            $query = $this->select('b.desc category, c.desc style, d.desc performance')
                ->from('bf_registration a')
                ->join('bf_category b', 'a.category = b.id')
                ->join('bf_style c', 'a.style = c.id')
                ->join('bf_performance d', 'a.performance = d.id')
                ->where('a.id', $regn_id);
            $query = $this->db->get();    
        }
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return null;
        }
    
    }
    
    public function find_regn_stats($profile_id = NULL){
        if ($profile_id == NULL){
            return FALSE;
        }else{
            $query = $this->select('a.id, b.desc category, c.desc style, d.desc performance, count(distinct e.team) team_count, count(distinct f.attachment) attachments')
                ->from('bf_registration a')
                ->join('bf_category b', 'a.category = b.id')
                ->join('bf_style c', 'a.style = c.id')
                ->join('bf_performance d', 'a.performance = d.id')
                ->join('registration_team e', 'a.id = e.registration and e.deleted = 0', 'left')
                ->join('registration_documents f', 'a.id = f.registration and f.deleted = 0', 'left')
                ->where('a.profile_id', $profile_id)
                ->where('a.deleted', 0)
                ->group_by('a.id');
            $query = $this->db->get();    
        }
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return null;
        }
    
    }
    
    public function find_regn_dtls($profile_id = NULL){
        if ($profile_id == NULL){
            return FALSE;
        }else{
            $query = $this->select('a.id, b.desc category, c.desc style, d.desc performance, g.name member_name')
                ->from('bf_registration a')
                ->join('bf_category b', 'a.category = b.id')
                ->join('bf_style c', 'a.style = c.id')
                ->join('bf_performance d', 'a.performance = d.id')
                ->join('registration_team e', 'a.id = e.registration', 'left')
                ->join('team g', 'e.team = g.id', 'left')
                ->where('a.profile_id', $profile_id)
                ->where('a.deleted', 0);
            $query = $this->db->get();    
        }
        
        if ($query->num_rows() > 0)
        {
            return $query->result();
        } else {
            return null;
        }
    
    }
    
}