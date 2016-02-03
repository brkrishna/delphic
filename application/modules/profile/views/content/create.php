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
<div class="row">
    <hr/>
    <h4>Create Profile</h4>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal'); ?>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
        <?php // Change the values in this array to populate your dropdown as required
            
            $options = array(
                'Organization' => 'Organization',
                'Individual' => 'Individual'
            );
            echo form_dropdown(array('name' => 'entity_type', 'class'=>'form-control', 'tabindex'=>'1', 'required'=>'', 'autofocus'=>''), $options, set_value('entity_type', isset($profile->entity_type) ? $profile->entity_type : ''), lang('profile_field_entity_type') . lang('bf_form_label_required'));
        ?>
        </div>
        <div class="form-group<?php echo form_error('entity_name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_entity_name') . lang('bf_form_label_required'), 'entity_name'); ?>
            <input tabindex='2' id='entity_name' class="form-control" type='text' required='required' name='entity_name' maxlength='255' value="<?php echo set_value('entity_name', isset($profile->entity_name) ? $profile->entity_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('entity_name'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('regn_nbr') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_regn_nbr'), 'regn_nbr', array('class' => 'control-label')); ?>
            <input tabindex='3' class="form-control" id='regn_nbr' type='text' name='regn_nbr' maxlength='255' value="<?php echo set_value('regn_nbr', isset($profile->regn_nbr) ? $profile->regn_nbr : ''); ?>" />
            <span class='help-inline'><?php echo form_error('regn_nbr'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('contact_name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_contact_name') . lang('bf_form_label_required'), 'contact_name', array('class' => 'control-label')); ?>
            <input tabindex='4' id='contact_name' class="form-control" type='text' required='required' name='contact_name' maxlength='255' value="<?php echo set_value('contact_name', isset($profile->contact_name) ? $profile->contact_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_name'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('contact_number') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_contact_number') . lang('bf_form_label_required'), 'contact_number', array('class' => 'control-label')); ?>
            <input tabindex='5' class="form-control" id='contact_number' type='text' required='required' name='contact_number' maxlength='50' value="<?php echo set_value('contact_number', isset($profile->contact_number) ? $profile->contact_number : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_number'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('alt_contact_number') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_alt_contact_number'), 'alt_contact_number', array('class' => 'control-label')); ?>
            <input tabindex='6' class="form-control" id='alt_contact_number' type='text' required='required' name='contact_number' maxlength='50' value="<?php echo set_value('alt_contact_number', isset($profile->alt_contact_number) ? $profile->alt_contact_number : ''); ?>" />
            <span class='help-inline'><?php echo form_error('alt_contact_number'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('address') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_address'), 'address', array('class' => 'control-label')); ?>
            <input tabindex='7' class="form-control" id='address' type='text' required='required' name='address' maxlength='255' value="<?php echo set_value('address', isset($profile->address) ? $profile->address : ''); ?>" />
            <span class='help-inline'><?php echo form_error('address'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('city') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
            <input tabindex='8' class="form-control" id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($profile->city) ? $profile->city : ''); ?>" />
            <span class='help-inline'><?php echo form_error('city'); ?></span>
        </div>
        <div class="form-group">
        <?php 
            if (is_array($countries_select) && count($countries_select)) :
                echo form_dropdown(array('name' => 'country', 'class'=>'form-control', 'tabindex'=>'10'), $countries_select, set_value('country', isset($profile->country) ? $profile->country : ''), 'Country'. lang('bf_form_label_required'));
            endif;
        ?>
        </div>
        <div class="form-group<?php echo form_error('post_code') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_post_code'), 'post_code', array('class' => 'control-label')); ?>
            <input tabindex='11' class="form-control" id='post_code' type='text' name='post_code' maxlength='10' value="<?php echo set_value('post_code', isset($profile->post_code) ? $profile->post_code : ''); ?>" />
            <span class='help-inline'><?php echo form_error('post_code'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('email_id') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
            <input tabindex='12' class="form-control" id='email_id' type='email' required='required' name='email_id' maxlength='255' value="<?php echo set_value('email_id', isset($profile->email_id) ? $profile->email_id : ''); ?> " />
            <span class='help-inline'><?php echo form_error('email_id'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('profile') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_profile') . lang('bf_form_label_required'), 'profile', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'name' => 'profile', 'id' => 'profile', 'rows' => '8', 'cols' => '80', 'tabindex'=>'13', 'value' => set_value('profile', isset($profile->profile) ? $profile->profile : ''))); ?>
            <span class='help-inline'><?php echo form_error('profile'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('addl_info') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_addl_info'), 'addl_info', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'name' => 'addl_info', 'id' => 'addl_info', 'rows' => '8', 'cols' => '80',  'tabindex'=>'14', 'value' => set_value('addl_info', isset($profile->addl_info) ? $profile->addl_info : ''))); ?>
            <span class='help-inline'><?php echo form_error('addl_info'); ?></span>
        </div>
        <div class="form-group">
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('profile_action_create'); ?>" tabindex='14'/>
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(base_url(), lang('profile_cancel'), 'class="btn btn-warning"', "tabindex='16'"); ?>
        </div>
        <hr/>
    </div>
    <?php echo form_close(); ?>
</div>