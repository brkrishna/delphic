<?php defined('BASEPATH') || exit('No direct script access allowed');

class Team_model extends BF_Model
{
    protected $table_name	= 'team';
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
			'label' => 'lang:team_field_profile_id',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'name',
			'label' => 'lang:team_field_name',
			'rules' => 'required|max_length[255]',
		),
		array(
			'field' => 'gender',
			'label' => 'lang:team_field_gender',
			'rules' => 'max_length[50]',
		),
		array(
			'field' => 'dob',
			'label' => 'lang:team_field_dob',
			'rules' => 'max_length[10]',
		),
		array(
			'field' => 'contact_nbr',
			'label' => 'lang:team_field_contact_nbr',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'email',
			'label' => 'lang:team_field_email',
			'rules' => 'valid_email|max_length[255]',
		),
		array(
			'field' => 'profession',
			'label' => 'lang:team_field_profession',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'profile',
			'label' => 'lang:team_field_profile',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'passport_nbr',
			'label' => 'lang:team_field_passport_nbr',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'place_of_issue',
			'label' => 'lang:team_field_place_of_issue',
			'rules' => 'max_length[255]',
		),
		array(
			'field' => 'date_of_issue',
			'label' => 'lang:team_field_date_of_issue',
			'rules' => '',
		),
		array(
			'field' => 'date_of_expiry',
			'label' => 'lang:team_field_date_of_expiry',
			'rules' => '',
		),
		array(
			'field' => 'attachment',
			'label' => 'lang:team_field_attachment',
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
            $query = $this->db->get_where($this->table_name, array('profile_id'=>$profile_id));
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
    
	public function get_teams_select ($profile_id = NULL )
	{
	    if($profile_id != NULL) {
	        $query = $this->db->select('id, name')->get_where($this->table_name, array('deleted'=>0, 'profile_id'=>$profile_id));
	    }else{
	        $query = $this->db->select('id, name')->get_where($this->table_name, array('deleted'=>0));
	    }
		
		if ( $query->num_rows() <= 0 )
			return '';

		$option = array('-1'=>'Select one');
		foreach ($query->result() as $row)
		{
			$option[$row->id] = $row->name;
		}

		$query->free_result();

		return $option;
	}

    function validate_age($dob, $restriction = 18) {
     
        $dates = explode("-", $dob);    // Exploding sections of date into array
        
        $year = date("Y") - $dates["0"];    // Subtracting entered year from current year
        $month = date("m") - $dates["1"];   // Subtracting entered month from current month
        $day = date("d") - $dates["2"]; // Subtracting entered day from current day
         
        // If month is negative, means it's a year earlier - Decrement year by 1. Else if month is 0 and day is negative, means it's a year earlier - Decrement year by 1
        if ($month < 0) {
            $year--;
        } elseif ($month == 0 && $day < 0) {
            $year--;
        }
         
        // If customer's age is greater than or equal to certificate then age is valid, else it's invalid
        echo ($year);
        if ($year >= $restriction) { 
            $valid_age = TRUE;
        } else {
            $this->form_validation->set_message('validation_validate_age', 'The %s field can not be less than 18 years');
            $valid_age = FALSE;
        }
         
        return $valid_age;  // Return TRUE or FALSE whether customer is old enough to purchase product
    }    	

	//--------------------------------------------------------------------
}