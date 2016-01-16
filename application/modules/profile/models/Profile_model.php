<?php defined('BASEPATH') || exit('No direct script access allowed');

class Profile_model extends BF_Model
{
    protected $table_name	= 'profile';
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
			'field' => 'entity_type',
			'label' => 'lang:profile_field_entity_type',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'entity_name',
			'label' => 'lang:profile_field_entity_name',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'contact_name',
			'label' => 'lang:profile_field_contact_name',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'address',
			'label' => 'lang:profile_field_address',
			'rules' => 'required|max_length[1000]',
		),
		array(
			'field' => 'city',
			'label' => 'lang:profile_field_city',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'country',
			'label' => 'lang:profile_field_country',
			'rules' => 'required|max_length[10]',
		),
		array(
			'field' => 'post_code',
			'label' => 'lang:profile_field_post_code',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'contact_number',
			'label' => 'lang:profile_field_contact_number',
			'rules' => 'required|max_length[50]',
		),
		array(
			'field' => 'email_id',
			'label' => 'lang:profile_field_email_id',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'regn_nbr',
			'label' => 'lang:profile_field_regn_nbr',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'profile',
			'label' => 'lang:profile_field_profile',
			'rules' => 'required|max_length[1000]',
		),
		array(
			'field' => 'addl_info',
			'label' => 'lang:profile_field_addl_info',
			'rules' => 'max_length[1000]',
		),
		array(
			'field' => 'image',
			'label' => 'lang:profile_field_image',
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
            $query = $this->db->get_where($this->table_name, array('id'=>$profile_id));
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
}