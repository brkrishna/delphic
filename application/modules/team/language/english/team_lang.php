<?php defined('BASEPATH') || exit('No direct script access allowed');


$lang['team_manage']      = 'Manage Team';
$lang['team_edit']        = 'Edit';
$lang['team_true']        = 'True';
$lang['team_false']       = 'False';
$lang['team_create']      = 'Create';
$lang['team_list']        = 'List';
$lang['team_new']       = 'New';
$lang['team_edit_text']     = 'Edit this to suit your needs';
$lang['team_no_records']    = 'There are no team in the system.';
$lang['team_create_new']    = 'Create a new Team.';
$lang['team_create_success']  = 'Team successfully created.';
$lang['team_create_failure']  = 'There was a problem creating the team: ';
$lang['team_create_new_button'] = 'Create New Team';
$lang['team_invalid_id']    = 'Invalid Team ID.';
$lang['team_edit_success']    = 'Team successfully saved.';
$lang['team_edit_failure']    = 'There was a problem saving the team: ';
$lang['team_delete_success']  = 'record(s) successfully deleted.';
$lang['team_delete_failure']  = 'We could not delete the record: ';
$lang['team_delete_error']    = 'You have not selected any records to delete.';
$lang['team_actions']     = 'Actions';
$lang['team_cancel']      = 'Cancel';
$lang['team_delete_record']   = 'Delete this Team';
$lang['team_delete_confirm']  = 'Are you sure you want to delete this team?';
$lang['team_edit_heading']    = 'Edit Team';

// Create/Edit Buttons
$lang['team_action_edit']   = 'Save Team Member';
$lang['team_action_create']   = 'Save Team Member';
$lang['team_action_create_event']   = 'Continue to Register for an Event';

// Activities
$lang['team_act_create_record'] = 'Created record with ID';
$lang['team_act_edit_record'] = 'Updated record with ID';
$lang['team_act_delete_record'] = 'Deleted record with ID';

//Listing Specifics
$lang['team_records_empty']    = 'No records found that match your selection.';
$lang['team_errors_message']    = 'Please fix the following errors:';

// Column Headings
$lang['team_column_created']  = 'Created';
$lang['team_column_deleted']  = 'Deleted';
$lang['team_column_modified'] = 'Modified';
$lang['team_column_deleted_by'] = 'Deleted By';
$lang['team_column_created_by'] = 'Created By';
$lang['team_column_modified_by'] = 'Modified By';

// Module Details
$lang['team_module_name'] = 'Team';
$lang['team_module_description'] = 'Team';
$lang['team_area_title'] = 'Team';

// Fields
$lang['team_field_profile_id'] = 'Profile';
$lang['team_field_member_type'] = 'Member Type';
$lang['team_field_name'] = 'First Name';
$lang['team_field_last_name'] = 'Last Name';
$lang['team_field_gender'] = 'Gender';
$lang['team_field_dob'] = 'Date of Birth';
$lang['team_field_contact_nbr'] = 'Contact Number';
$lang['team_field_alt_contact_nbr'] = 'Alternate Contact Number';
$lang['team_field_email'] = 'Email';
$lang['team_field_profession'] = 'Profession';
$lang['team_field_profile'] = 'Brief Profile';
$lang['team_field_passport_nbr'] = 'Passport Number';
$lang['team_field_place_of_issue'] = 'Place of Issue';
$lang['team_field_date_of_issue'] = 'Date of Issue';
$lang['team_field_date_of_expiry'] = 'Date of Expiry';
$lang['team_field_attachment_type'] = 'ID Proof Type';
$lang['team_field_attachment'] = 'ID Proof';

// Validations
$lang['form_validation_validate_age'] = 'Cannot register a person less than 18 years old';
$lang['form_validation_phone_regex'] = 'Please enter a valid phone number. Should contain 10 - 14 digits without spaces or any special characters';
$lang['form_validation_is_birthdate'] = 'Please check %s, a person should be more than 18 years of age';
$lang['form_validation_is_valid_dt_of_issue'] = 'Please check %s, should be less than 3 months from today\'s date';
$lang['form_validation_is_valid_dt_of_expiry'] = 'Please check %s, should be more than 6 months from today\'s date';