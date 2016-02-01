<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Countries_model extends BF_Model {
	//--------------------------------------------------------------------

	public function get_countries_select ( )
	{
		$query = $this->db->select('iso, name')->get('countries');

		if ( $query->num_rows() <= 0 )
			return '';

		$option = array('-1'=>'Select one');
		foreach ($query->result() as $row)
		{
			$option[$row->iso] = $row->name;
		}

		$query->free_result();

		return $option;
	}

	//--------------------------------------------------------------------

}