<?php defined('BASEPATH') || exit('No direct script access allowed');

class Event_registration_model extends BF_Model
{
    protected $table_name	= 'regn';
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
			'field' => 'profile',
			'label' => 'lang:event_registration_field_profile',
			'rules' => 'is_natural_no_zero',
		),
		array(
			'field' => 'category',
			'label' => 'lang:event_registration_field_category',
			'rules' => 'is_natural_no_zero',
		),
		array(
			'field' => 'style',
			'label' => 'lang:event_registration_field_style',
			'rules' => 'is_natural_no_zero',
		),
		array(
			'field' => 'performance',
			'label' => 'lang:event_registration_field_performance',
			'rules' => 'is_natural_no_zero',
		),
		array(
			'field' => 'team',
			'label' => 'lang:event_registration_field_team',
			'rules' => '',
		),
		array(
			'field' => 'notes',
			'label' => 'lang:event_registration_field_notes',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'attach_1',
			'label' => 'lang:event_registration_field_attach_1',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'attach_2',
			'label' => 'lang:event_registration_field_attach_2',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'attach_3',
			'label' => 'lang:event_registration_field_attach_3',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'attach_4',
			'label' => 'lang:event_registration_field_attach_4',
			'rules' => 'max_length[4000]',
		),
		array(
			'field' => 'attach_5',
			'label' => 'lang:event_registration_field_attach_5',
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
}