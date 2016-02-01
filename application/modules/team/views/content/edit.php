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
<div class="row-fluid">
    <ul class="nav nav-pills">
        <?php echo Modules::run('profile/profile_status'); ?>
    </ul>
</div>
<div class="row-fluid">
    <h3 class="text-center">Team</h3>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-inline"'); ?>
        <fieldset>
            <div class="col-md-4">
                <div class="control-group<?php echo form_error('name') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_name') . lang('bf_form_label_required'), 'name', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input id='name' type='text' required='required' name='name' maxlength='255' value="<?php echo set_value('name', isset($team->name) ? $team->name : ''); ?>" tabindex='1' />
                        <span class='help-inline'><?php echo form_error('name'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('dob') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_dob'), 'dob', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input id='dob' type='text' name='dob' maxlength='255' value="<?php echo set_value('dob', isset($team->dob) ? $team->dob : ''); ?>" tabindex='4' />
                        <span class='help-inline'><?php echo form_error('dob'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('passport_nbr') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_passport_nbr'), 'passport_nbr', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='7' id='passport_nbr' type='text' name='passport_nbr' maxlength='255' value="<?php echo set_value('passport_nbr', isset($team->passport_nbr) ? $team->passport_nbr : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('passport_nbr'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('place_of_issue') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_place_of_issue'), 'place_of_issue', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='10' id='place_of_issue' type='text' name='place_of_issue' maxlength='255' value="<?php echo set_value('place_of_issue', isset($team->place_of_issue) ? $team->place_of_issue : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('place_of_issue'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('profile') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_profile'), 'profile', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <?php echo form_textarea(array('tabindex'=>'13', 'name' => 'profile', 'id' => 'profile', 'rows' => '5', 'cols' => '80', 'value' => set_value('profile', isset($team->profile) ? $team->profile : ''))); ?>
                        <span class='help-inline'><?php echo form_error('profile'); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <?php 
                    $options = array(
                        'Undisclosed' => 'Prefer not to disclose',
                        'Male' => 'Male',
                        'Female' => 'Female',
                    );
                    echo form_dropdown(array('name' => 'gender', 'tabindex' => '2'), $options, set_value('gender', isset($team->gender) ? $team->gender : ''), lang('team_field_gender'));
                ?>
                <div class="control-group<?php echo form_error('email') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_email'), 'email', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='5' id='email' type='text' name='email' maxlength='255' value="<?php echo set_value('email', isset($team->email) ? $team->email : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('email'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('date_of_issue') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_date_of_issue'), 'date_of_issue', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='8' id='date_of_issue' type='text' name='date_of_issue'  value="<?php echo set_value('date_of_issue', isset($team->date_of_issue) ? $team->date_of_issue : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('date_of_issue'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('attachment') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_attachment'), 'attachment', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <?php if(isset($team->attachment)) : ?>
                            <?php echo(isset($team->attachment) ? anchor(base_url() . 'uploads/' . unserialize($team->attachment)['file_name'], unserialize($team->attachment)['file_name']) : ''); ?>
                        <?php endif; ?>
                        <input class="btn btn-primary" tabindex='11' id='attachment' type='file' name='attachment' maxlength='4000' value="<?php echo set_value('attachment', isset($team->attachment) ? $team->attachment : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('attachment'); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="control-group<?php echo form_error('contact_nbr') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_contact_nbr'), 'contact_nbr', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='3' id='contact_nbr' type='text' name='contact_nbr' maxlength='255' value="<?php echo set_value('contact_nbr', isset($team->contact_nbr) ? $team->contact_nbr : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('contact_nbr'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('profession') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_profession'), 'profession', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='6' id='profession' type='text' name='profession' maxlength='255' value="<?php echo set_value('profession', isset($team->profession) ? $team->profession : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('profession'); ?></span>
                    </div>
                </div>
                <div class="control-group<?php echo form_error('date_of_expiry') ? ' error' : ''; ?>">
                    <?php echo form_label(lang('team_field_date_of_expiry'), 'date_of_expiry', array('class' => 'control-label')); ?>
                    <div class='controls'>
                        <input tabindex='9' id='date_of_expiry' type='text' name='date_of_expiry'  value="<?php echo set_value('date_of_expiry', isset($team->date_of_expiry) ? $team->date_of_expiry : ''); ?>" />
                        <span class='help-inline'><?php echo form_error('date_of_expiry'); ?></span>
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <div class="col-md-8">
                <input tabindex='14' type='submit' name='save' class='btn btn-primary' value="<?php echo lang('team_action_create'); ?>" />
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(SITE_AREA . '/content/team', lang('team_cancel'), 'class="btn btn-warning", tabindex="15"'); ?>
                <hr/>
            </div>            
        </fieldset>
    <?php echo form_close(); ?>
</div>