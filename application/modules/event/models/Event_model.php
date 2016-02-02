<?php defined('BASEPATH') || exit('No direct script access allowed');

class Event_model extends BF_Model
{
    protected $table_name	= 'event';
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
			'field' => 'category',
			'label' => 'lang:event_field_category',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'style',
			'label' => 'lang:event_field_style',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'performance',
			'label' => 'lang:event_field_performance',
			'rules' => 'required|is_numeric',
		),
		array(
			'field' => 'sort_order',
			'label' => 'lang:event_field_sort_order',
			'rules' => 'required|unique[bf_event.sort_order,bf_event.id]|is_numeric',
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
    
	public function get_category_styles($category = NULL)
	{   
	    if($category != NULL) {
	        $query = $this->db->select('style, desc')->from($this->table_name)->join('style', 'event.style = style.id')->where(array('event.deleted'=>0, 'category'=>$category))->get();
	        
	    }else{
	        return '';
	    }

		if ( $query->num_rows() <= 0 )
			return '';

		$option = array('-1'=>'Select one');
		foreach ($query->result() as $row)
		{
			$option[$row->style] = $row->desc;
		}
    
		$query->free_result();

		return $option;
	}
    
	public function get_style_performances($style = NULL)
	{   
	    if($style != NULL) {
	        $query = $this->db->select('performance, desc')->from($this->table_name)->join('performance', 'event.performance = performance.id')->where(array('event.deleted'=>0, 'style'=>$style))->get();
	        
	    }else{
	        return '';
	    }

		if ( $query->num_rows() <= 0 )
			return '';

		$option = array('-1'=>'Select one');
		foreach ($query->result() as $row)
		{
			$option[$row->performance] = $row->desc;
		}
    
		$query->free_result();

		return $option;
	}
}