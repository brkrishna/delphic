<?php defined('BASEPATH') || exit('No direct script access allowed');

class Signup_model extends BF_Model
{
    protected $table_name	= 'signup';
	protected $key			= 'id';
	protected $date_format	= 'datetime';

	protected $log_user 	= true;
	protected $set_created	= true;
	protected $set_modified = true;
	protected $soft_deletes	= true;

	protected $created_field     = 'created_on';
    //protected $created_by_field  = 'created_by';
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
			'field' => 'first_name',
			'label' => 'lang:signup_field_first_name',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'middle_name',
			'label' => 'lang:signup_field_middle_name',
			'rules' => 'trim|max_length[255]',
		),
		array(
			'field' => 'last_name',
			'label' => 'lang:signup_field_last_name',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'email_id',
			'label' => 'lang:signup_field_email_id',
			'rules' => 'required|unique[bf_signup.email_id,bf_signup.id]|trim|valid_email|max_length[255]',
		),
		array(
			'field' => 'password',
			'label' => 'lang:signup_field_password',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'mobile',
			'label' => 'lang:signup_field_mobile',
			'rules' => 'required|trim|is_natural|max_length[255]',
		),
		array(
			'field' => 'address',
			'label' => 'lang:signup_field_address',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'city',
			'label' => 'lang:signup_field_city',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'post_code',
			'label' => 'lang:signup_field_post_code',
			'rules' => 'required|trim|max_length[50]',
		),
		array(
			'field' => 'country',
			'label' => 'lang:signup_field_country',
			'rules' => 'required|trim|max_length[10]',
		),
		array(
			'field' => 'dob',
			'label' => 'lang:signup_field_dob',
			'rules' => 'required|trim|max_length[10]',
		),
		array(
			'field' => 'gender',
			'label' => 'lang:signup_field_gender',
			'rules' => 'required|trim|max_length[15]',
		),
		array(
			'field' => 'mode',
			'label' => 'lang:signup_field_mode',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'representation',
			'label' => 'lang:signup_field_representation',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'team',
			'label' => 'lang:signup_field_team',
			'rules' => 'required|trim|max_length[255]',
		),
		array(
			'field' => 'categories',
			'label' => 'lang:signup_field_categories',
			'rules' => 'required|trim|max_length[1000]',
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
}