<?php defined('BASEPATH') || exit('No direct script access allowed');
/**
 * Bonfire
 *
 * An open source project to allow developers to jumpstart their development of
 * CodeIgniter applications.
 *
 * @package   Bonfire
 * @author    Bonfire Dev Team
 * @copyright Copyright (c) 2011 - 2014, Bonfire Dev Team
 * @license   http://opensource.org/licenses/MIT
 * @link      http://cibonfire.com
 * @since     Version 1.0
 * @filesource
 */

//------------------------------------------------------------------------------
// User Meta Fields Config - These are just examples of various options
// The following examples show how to use regular inputs, select boxes,
// state and country select boxes.
//------------------------------------------------------------------------------

$config['user_meta_fields'] =  array(
	/*
	array(
		'name'   => 'state',
		'label'   => lang('user_meta_state'),
        'rules'         => 'trim|max_length[3]',
		'form_detail' => array(
			'type' => 'state_select',
			'settings' => array(
				'name'		=> 'state',
				'id'		=> 'state',
                'maxlength' => '3',
				'class'		=> 'span1'
			),
		),
	),
	*/
	array(
		'name'   => 'first_name',
		'label'   => lang('user_meta_first_name'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'first_name',
				'id'		=> 'first_name',
				'maxlength'	=> '100',
				'class'		=> 'form-control'
			)
		),
	),

	array(
		'name'   => 'middle_name',
		'label'   => lang('user_meta_middle_name'),
		'rules'   => 'trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'middle_name',
				'id'		=> 'middle_name',
				'maxlength'	=> '100',
				'class'		=> 'form-control'
			),
		),
	),
	array(
		'name'   => 'last_name',
		'label'   => lang('user_meta_last_name'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'last_name',
				'id'		=> 'last_name',
				'maxlength'	=> '100',
				'class'		=> 'form-control'
			),
		),
	),
	array(
		'name'   => 'dob',
		'label'   => lang('user_meta_dob'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'dob',
				'id'		=> 'dob',
				'maxlength'	=> '100',
				'class'		=> 'form-control',
				'placeholder' => 'YYYY/MM/DD',
			),
		),
	),
	array(
		'name'   => 'gender',
		'label'   => lang('user_meta_gender'),
		'rules'   => 'required|trim|max_length[10]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'dropdown',
			'settings' => array(
				'name'		=> 'gender',
				'id'		=> 'gender',
				'maxlength'	=> '10',
				'class'		=> 'form-control'
			),
			'options' => array(
				'Male' => 'Male', 
				'Female'=>'Female', 
				'Others'=>'Others'
			),			
		),
	),
	array(
		'name'   => 'mobile',
		'label'   => lang('user_meta_mobile'),
		'rules'   => 'required|trim|max_length[14]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'mobile',
				'id'		=> 'mobile',
				'maxlength'	=> '14',
				'class'		=> 'form-control',
				'placeholder' => '9999999999'
			),
		),
	),

	array(
		'name'   => 'address',
		'label'   => lang('user_meta_address'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'address',
				'id'		=> 'address',
				'maxlength'	=> '100',
				'class'		=> 'form-control'
			),
		),
	),

	array(
		'name'   => 'city',
		'label'   => lang('user_meta_city'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'city',
				'id'		=> 'city',
				'maxlength'	=> '100',
				'class'		=> 'form-control'
			),
		),
	),

	array(
		'name'   => 'zip',
		'label'   => lang('user_meta_zip'),
		'rules'   => 'required|trim|max_length[50]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'input',
			'settings' => array(
				'name'		=> 'zip',
				'id'		=> 'zip',
				'maxlength'	=> '50',
				'class'		=> 'form-control'
			),
		),
	),
	array(
		'name'   => 'country',
		'label'   => lang('user_meta_country'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'country_select',
			'settings' => array(
				'name'		=> 'country',
				'id'		=> 'country',
				'maxlength'	=> '100',
				'class'		=> 'span6'
			),
		),
	),
	array(
		'name'   => 'participate',
		'label'   => lang('user_meta_participate'),
		'rules'   => 'required|trim|max_length[50]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'dropdown',
			'settings' => array(
				'name'		=> 'participate',
				'id'		=> 'participate',
				'maxlength'	=> '50',
				'class'		=> 'form-control'
			),
			'options' => array(
				'Competitor' => 'Competitor', 
				'Exhibitor'=>'Exhibitor', 
				'Performer'=>'Performer'
			),			
		),
	),
	array(
		'name'   => 'mode',
		'label'   => lang('user_meta_mode'),
		'rules'   => 'required|trim|max_length[50]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'dropdown',
			'settings' => array(
				'name'		=> 'mode',
				'id'		=> 'mode',
				'maxlength'	=> '50',
				'class'		=> 'form-control'
			),
			'options' => array(
				'Participant' => 'Participant', 
				'Representative'=>'Representative of a Participant', 
			),			
		),
	),
	array(
		'name'   => 'team',
		'label'   => lang('user_meta_team'),
		'rules'   => 'required|trim|max_length[50]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'dropdown',
			'settings' => array(
				'name'		=> 'team',
				'id'		=> 'team',
				'maxlength'	=> '50',
				'class'		=> 'form-control'
			),
			'options' => array(
				'Individual' => 'Individual', 
				'Group/Team'=>'Group/Team', 
				'Multiple Groups/Teams'=>'Multile Groups/Teams'
			),			
		),
	),
	array(
		'name'   => 'categories',
		'label'   => lang('user_meta_categories'),
		'rules'   => 'required|trim|max_length[100]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'dropdown',
			'settings' => array(
				'name'		=> 'categories',
				'id'		=> 'categories',
				'maxlength'	=> '100',
				'rows'      => '8',
				'class'		=> 'form-control',
			),
			'options' => array(
				'MAS' => 'Musical Arts and Sounds', 
				'PA'=>'Performance Arts', 
				'LA'=>'Language Arts',
				'Visual Arts'=>'Visual Arts',
				'SAC'=>'Social Arts and Communication',
				'EAA'=>'Ecological Arts and Architecture'
			),			
		),
	),
	array(
		'name' => 'helplink',
		'label' => lang('user_meta_categories_help'),
		'rules' => '',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'anchor',
			'href' => 'http://www.youthdelphicgames.com/art-categories.php',
			'caption'=>'Click here to review Categories',
			'settings' => array(
				'title' => 'Art Categories',
				'target' => '_new',
			),
		),
	),
	array(
		'name'   => 'comments',
		'label'   => lang('user_meta_comments'),
		'rules'   => 'required|trim|max_length[1000]',
        'admin_only'    => false,
		'form_detail' => array(
			'type' => 'textarea',
			'settings' => array(
				'name'		=> 'comments',
				'id'		=> 'comments',
				'maxlength'	=> '1000',
				'rows'      => '8',
				'class'		=> 'form-control',
				'placeholder' => 'Remarks/Comments...'
			),			
		),
	),
	
);