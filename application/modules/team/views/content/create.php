<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('team_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($team->id) ? $team->id : '';

?>
<div class="row">
    <hr/>
    <h4>Add Team Member</h4>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="form-group">
            <?php // Change the values in this array to populate your dropdown as required
                
                $options = array(
                    'Indian Citizen' => 'Indian Citizen',
                    'International Participant' => 'International Participant'
                );
                echo form_dropdown(array('name' => 'member_type', 'class'=>'form-control', 'tabindex'=>'1', 'required'=>'', 'autofocus'=>''), $options, set_value('member_type', isset($team->member_type) ? $team->member_type : ''), lang('team_field_member_type') . lang('bf_form_label_required'));
            ?>
            </div>
            <div class="form-group<?php echo form_error('name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_name') . lang('bf_form_label_required'), 'name', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='2' id='name' type='text' required name='name' maxlength='255' value="<?php echo set_value('name', isset($team->name) ? $team->name : ''); ?>" />
                <span class='help-inline'><?php echo form_error('name'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('last_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_last_name') . lang('bf_form_label_required'), 'last_name', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='3' id='name' type='text' name='last_name' maxlength='255' value="<?php echo set_value('last_name', isset($team->last_name) ? $team->last_name : ''); ?>" />
                <span class='help-inline'><?php echo form_error('last_name'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('dob') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_dob'), 'dob', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='4' id='dob' type='text' name='dob' maxlength='255' value="<?php echo set_value('dob', isset($team->dob) ? $team->dob : ''); ?>" tabindex='4' />
                <span class='help-inline'><?php echo form_error('dob'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('contact_nbr') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_contact_nbr'), 'contact_nbr', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='5' id='contact_nbr' type='text' name='contact_nbr' maxlength='255' value="<?php echo set_value('contact_nbr', isset($team->contact_nbr) ? $team->contact_nbr : ''); ?>" />
                <span class='help-inline'><?php echo form_error('contact_nbr'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('alt_contact_nbr') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_alt_contact_nbr'), 'alt_contact_nbr', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='6' id='alt_contact_nbr' type='text' name='alt_contact_nbr' maxlength='50' value="<?php echo set_value('alt_contact_nbr', isset($team->alt_contact_nbr) ? $team->alt_contact_nbr : ''); ?>" />
                <span class='help-inline'><?php echo form_error('alt_contact_nbr'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('email') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_email'), 'email', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='7' id='email' type='email' name='email' maxlength='255' value="<?php echo set_value('email', isset($team->email) ? $team->email : ''); ?>" />
                <span class='help-inline'><?php echo form_error('email'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('profession') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_profession'), 'profession', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='8' id='profession' type='text' name='profession' maxlength='255' value="<?php echo set_value('profession', isset($team->profession) ? $team->profession : ''); ?>" />
                <span class='help-inline'><?php echo form_error('profession'); ?></span>
            </div>

            <div class="form-group<?php echo form_error('passport_nbr') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_passport_nbr'), 'passport_nbr', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='9' id='passport_nbr' type='text' name='passport_nbr' maxlength='255' value="<?php echo set_value('passport_nbr', isset($team->passport_nbr) ? $team->passport_nbr : ''); ?>" />
                <span class='help-inline'><?php echo form_error('passport_nbr'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('place_of_issue') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_place_of_issue'), 'place_of_issue', array('class' => 'control-label')); ?>
                <input class="form-control" tabindex='10' id='place_of_issue' type='text' name='place_of_issue' maxlength='255' value="<?php echo set_value('place_of_issue', isset($team->place_of_issue) ? $team->place_of_issue : ''); ?>" />
                <span class='help-inline'><?php echo form_error('place_of_issue'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('date_of_issue') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_date_of_issue'), 'date_of_issue', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='11' id='date_of_issue' type='text' name='date_of_issue'  value="<?php echo set_value('date_of_issue', isset($team->date_of_issue) ? $team->date_of_issue : ''); ?>" />
                <span class='help-inline'><?php echo form_error('date_of_issue'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('date_of_expiry') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_date_of_expiry'), 'date_of_expiry', array('class' => 'control-label')); ?>
                <input class='form-control' tabindex='12' id='date_of_expiry' type='text' name='date_of_expiry'  value="<?php echo set_value('date_of_expiry', isset($team->date_of_expiry) ? $team->date_of_expiry : ''); ?>" />
                <span class='help-inline'><?php echo form_error('date_of_expiry'); ?></span>
            </div>
            <div class="form-group">
            <?php // Change the values in this array to populate your dropdown as required
                
                $options = array(
                    '-1' => 'Select one',
                    'International Passport' => 'International Passport',
                    'Indian Passport' => 'Indian Passport',
                    'Aadhar UID' => 'Aadhar UID',
                    'Driving License' => 'Driving License',
                    'Other'=>'Other'
                );
                echo form_dropdown(array('name' => 'attachment_type', 'class'=>'form-control', 'tabindex'=>'13', 'required'=>'', 'autofocus'=>''), $options, set_value('attachment_type', isset($team->attachment_type) ? $team->attachment_type : ''), lang('team_field_attachment_type') . lang('bf_form_label_required'));
            ?>
            </div>
            <div class="form-group<?php echo form_error('attachment') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_attachment'), 'attachment', array('class' => 'control-label')); ?>
                <?php if(isset($team->attachment)) : ?>
                    <?php echo(isset($team->attachment) ? anchor(base_url() . 'uploads/' . unserialize($team->attachment)['file_name'], unserialize($team->attachment)['file_name']) : ''); ?>
                <?php endif; ?>
                <input class="btn btn-primary" tabindex='14' id='attachment' type='file' name='attachment' maxlength='4000' value="<?php echo set_value('attachment', isset($team->attachment) ? $team->attachment : ''); ?>" />
                <span class='help-inline'><?php echo form_error('attachment'); ?></span>
            </div>
            <div class="form-group<?php echo form_error('profile') ? ' error' : ''; ?>">
                <?php echo form_label(lang('team_field_profile'), 'profile', array('class' => 'control-label')); ?>
                <?php echo form_textarea(array('class'=>'form-control', 'tabindex'=>'15', 'name' => 'profile', 'id' => 'profile', 'rows' => '5', 'cols' => '80', 'value' => set_value('profile', isset($team->profile) ? $team->profile : ''))); ?>
                <span class='help-inline'><?php echo form_error('profile'); ?></span>
            </div>       
            <div class="form-group">
                <input tabindex='16' type='submit' name='save' class='btn btn-primary' value="<?php echo lang('team_action_create'); ?>" />
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(SITE_AREA . '/content/team', lang('team_cancel'), array('class'=>'btn btn-warning', 'tabindex'=>'17')); ?>
            </div>            
        </div>
    <?php echo form_close(); ?>
</div>