<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('signup_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($signup->id) ? $signup->id : '';

?>
<div class='admin-box'>
    <h3>Signup</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('first_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_first_name') . lang('bf_form_label_required'), 'first_name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='first_name' type='text' required='required' name='first_name' maxlength='255' value="<?php echo set_value('first_name', isset($signup->first_name) ? $signup->first_name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('first_name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('middle_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_middle_name'), 'middle_name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='middle_name' type='text' name='middle_name' maxlength='255' value="<?php echo set_value('middle_name', isset($signup->middle_name) ? $signup->middle_name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('middle_name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('last_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_last_name') . lang('bf_form_label_required'), 'last_name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='last_name' type='text' required='required' name='last_name' maxlength='255' value="<?php echo set_value('last_name', isset($signup->last_name) ? $signup->last_name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('last_name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('email_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='email_id' type='text' required='required' name='email_id' maxlength='255' value="<?php echo set_value('email_id', isset($signup->email_id) ? $signup->email_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('email_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('password') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_password') . lang('bf_form_label_required'), 'password', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='password' type='text' required='required' name='password' maxlength='255' value="<?php echo set_value('password', isset($signup->password) ? $signup->password : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('password'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('mobile') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_mobile') . lang('bf_form_label_required'), 'mobile', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='mobile' type='text' required='required' name='mobile' maxlength='255' value="<?php echo set_value('mobile', isset($signup->mobile) ? $signup->mobile : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('mobile'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('address') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_address') . lang('bf_form_label_required'), 'address', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='address' type='text' required='required' name='address' maxlength='255' value="<?php echo set_value('address', isset($signup->address) ? $signup->address : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('address'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('city') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($signup->city) ? $signup->city : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('city'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('post_code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_post_code') . lang('bf_form_label_required'), 'post_code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='post_code' type='text' required='required' name='post_code' maxlength='50' value="<?php echo set_value('post_code', isset($signup->post_code) ? $signup->post_code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('post_code'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    10 => 10,
                );
                echo form_dropdown(array('name' => 'country', 'required' => 'required'), $options, set_value('country', isset($signup->country) ? $signup->country : ''), lang('signup_field_country') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('dob') ? ' error' : ''; ?>">
                <?php echo form_label(lang('signup_field_dob') . lang('bf_form_label_required'), 'dob', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='dob' type='text' required='required' name='dob' maxlength='10' value="<?php echo set_value('dob', isset($signup->dob) ? $signup->dob : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('dob'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    15 => 15,
                );
                echo form_dropdown(array('name' => 'gender', 'required' => 'required'), $options, set_value('gender', isset($signup->gender) ? $signup->gender : ''), lang('signup_field_gender') . lang('bf_form_label_required'));
            ?>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    255 => 255,
                );
                echo form_dropdown(array('name' => 'mode', 'required' => 'required'), $options, set_value('mode', isset($signup->mode) ? $signup->mode : ''), lang('signup_field_mode') . lang('bf_form_label_required'));
            ?>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    255 => 255,
                );
                echo form_dropdown(array('name' => 'representation', 'required' => 'required'), $options, set_value('representation', isset($signup->representation) ? $signup->representation : ''), lang('signup_field_representation') . lang('bf_form_label_required'));
            ?>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    255 => 255,
                );
                echo form_dropdown(array('name' => 'team', 'required' => 'required'), $options, set_value('team', isset($signup->team) ? $signup->team : ''), lang('signup_field_team') . lang('bf_form_label_required'));
            ?>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    1000 => 1000,
                );
                echo form_dropdown(array('name' => 'categories', 'required' => 'required'), $options, set_value('categories', isset($signup->categories) ? $signup->categories : ''), lang('signup_field_categories') . lang('bf_form_label_required'));
            ?>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('signup_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/signup', lang('signup_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Signup.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('signup_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('signup_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>