<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('profile_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($profile->id) ? $profile->id : '';

?>
<div class='admin-box'>
    <h3>Profile</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    255 => 255,
                );
                echo form_dropdown(array('name' => 'entity_type', 'required' => 'required'), $options, set_value('entity_type', isset($profile->entity_type) ? $profile->entity_type : ''), lang('profile_field_entity_type') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('entity_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_entity_name') . lang('bf_form_label_required'), 'entity_name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='entity_name' class="form-control" type='text' required='required' name='entity_name' maxlength='255' value="<?php echo set_value('entity_name', isset($profile->entity_name) ? $profile->entity_name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('entity_name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('contact_name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_contact_name') . lang('bf_form_label_required'), 'contact_name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='contact_name' type='text' required='required' name='contact_name' maxlength='255' value="<?php echo set_value('contact_name', isset($profile->contact_name) ? $profile->contact_name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('contact_name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('address') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_address') . lang('bf_form_label_required'), 'address', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => '5', 'cols' => '80', 'value' => set_value('address', isset($profile->address) ? $profile->address : ''), 'required' => 'required')); ?>
                    <span class='help-inline'><?php echo form_error('address'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('city') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($profile->city) ? $profile->city : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('city'); ?></span>
                </div>
            </div>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    10 => 10,
                );
                echo form_dropdown(array('name' => 'country', 'required' => 'required'), $options, set_value('country', isset($profile->country) ? $profile->country : ''), lang('profile_field_country') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('post_code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_post_code'), 'post_code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='post_code' type='text' name='post_code' maxlength='10' value="<?php echo set_value('post_code', isset($profile->post_code) ? $profile->post_code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('post_code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('contact_number') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_contact_number') . lang('bf_form_label_required'), 'contact_number', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='contact_number' type='text' required='required' name='contact_number' maxlength='50' value="<?php echo set_value('contact_number', isset($profile->contact_number) ? $profile->contact_number : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('contact_number'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('email_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='email_id' type='text' required='required' name='email_id' maxlength='255' value="<?php echo set_value('email_id', isset($profile->email_id) ? $profile->email_id : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('email_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('regn_nbr') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_regn_nbr'), 'regn_nbr', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='regn_nbr' type='text' name='regn_nbr' maxlength='255' value="<?php echo set_value('regn_nbr', isset($profile->regn_nbr) ? $profile->regn_nbr : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('regn_nbr'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('profile') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_profile') . lang('bf_form_label_required'), 'profile', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'profile', 'id' => 'profile', 'rows' => '5', 'cols' => '80', 'value' => set_value('profile', isset($profile->profile) ? $profile->profile : ''), 'required' => 'required')); ?>
                    <span class='help-inline'><?php echo form_error('profile'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('addl_info') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_addl_info'), 'addl_info', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'addl_info', 'id' => 'addl_info', 'rows' => '5', 'cols' => '80', 'value' => set_value('addl_info', isset($profile->addl_info) ? $profile->addl_info : ''))); ?>
                    <span class='help-inline'><?php echo form_error('addl_info'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('image') ? ' error' : ''; ?>">
                <?php echo form_label(lang('profile_field_image'), 'image', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='image' type='text' name='image' maxlength='1000' value="<?php echo set_value('image', isset($profile->image) ? $profile->image : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('image'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('profile_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/profile', lang('profile_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>