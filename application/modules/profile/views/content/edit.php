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
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-inline"'); ?>
        <fieldset>
            <div class="row">
                <div class="span4">
                    <?php // Change the values in this array to populate your dropdown as required
                        $options = array(
                            'Organization' => 'Organization',
                            'Individual' => 'Individual'
                        );
                        echo form_dropdown(array('name' => 'entity_type', 'required' => 'required'), $options, set_value('entity_type', isset($profile->entity_type) ? $profile->entity_type : ''), lang('profile_field_entity_type') . lang('bf_form_label_required'), "tabindex='1'");
                    ?>
                    <div class="control-group<?php echo form_error('address') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_address') . lang('bf_form_label_required'), 'address', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => '8', 'cols' => '80', 'value' => set_value('address', isset($profile->address) ? $profile->address : ''), 'required' => 'required', 'tabindex'=>'4')); ?>
                            <span class='help-inline'><?php echo form_error('address'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('profile') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_profile') . lang('bf_form_label_required'), 'profile', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <?php echo form_textarea(array('name' => 'profile', 'id' => 'profile', 'rows' => '8', 'cols' => '80', 'tabindex'=>'11', 'value' => set_value('profile', isset($profile->profile) ? $profile->profile : ''), 'required' => 'required')); ?>
                            <span class='help-inline'><?php echo form_error('profile'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="control-group<?php echo form_error('entity_name') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_entity_name') . lang('bf_form_label_required'), 'entity_name', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='entity_name' type='text' required='required' name='entity_name' maxlength='255' value="<?php echo set_value('entity_name', isset($profile->entity_name) ? $profile->entity_name : ''); ?>" tabindex='2'/>
                            <span class='help-inline'><?php echo form_error('entity_name'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('city') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($profile->city) ? $profile->city : ''); ?>" tabindex='5'/>
                            <span class='help-inline'><?php echo form_error('city'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('contact_number') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_contact_number') . lang('bf_form_label_required'), 'contact_number', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='contact_number' type='text' required='required' name='contact_number' maxlength='50' value="<?php echo set_value('contact_number', isset($profile->contact_number) ? $profile->contact_number : ''); ?>" tabindex='7'/>
                            <span class='help-inline'><?php echo form_error('contact_number'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('post_code') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_post_code'), 'post_code', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='post_code' type='text' name='post_code' maxlength='10' value="<?php echo set_value('post_code', isset($profile->post_code) ? $profile->post_code : ''); ?>" tabindex='9'/>
                            <span class='help-inline'><?php echo form_error('post_code'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('addl_info') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_addl_info'), 'addl_info', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <?php echo form_textarea(array('name' => 'addl_info', 'id' => 'addl_info', 'rows' => '8', 'cols' => '80',  'tabindex'=>'12', 'value' => set_value('addl_info', isset($profile->addl_info) ? $profile->addl_info : ''))); ?>
                            <span class='help-inline'><?php echo form_error('addl_info'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="span4">
                    <div class="control-group<?php echo form_error('contact_name') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_contact_name') . lang('bf_form_label_required'), 'contact_name', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='contact_name' type='text' required='required' name='contact_name' maxlength='255' value="<?php echo set_value('contact_name', isset($profile->contact_name) ? $profile->contact_name : ''); ?>" tabindex='3' />
                            <span class='help-inline'><?php echo form_error('contact_name'); ?></span>
                        </div>
                    </div>
        			<?php // Change the values in this array to populate your dropdown as required
                        if (is_array($countries_select) && count($countries_select)) :
        				    echo form_dropdown('country', $countries_select, set_value('country', isset($profile->country) ? $profile->country : ''), 'Country'. lang('bf_form_label_required'), "tabindex='6'");
                        endif;
        			?>
                    <div class="control-group<?php echo form_error('email_id') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='email_id' type='text' required='required' name='email_id' maxlength='255' value="<?php echo set_value('email_id', isset($profile->email_id) ? $profile->email_id : ''); ?> " tabindex='8'/>
                            <span class='help-inline'><?php echo form_error('email_id'); ?></span>
                        </div>
                    </div>
                    <div class="control-group<?php echo form_error('regn_nbr') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_regn_nbr'), 'regn_nbr', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <input id='regn_nbr' type='text' name='regn_nbr' maxlength='255' value="<?php echo set_value('regn_nbr', isset($profile->regn_nbr) ? $profile->regn_nbr : ''); ?>" tabindex='10'/>
                            <span class='help-inline'><?php echo form_error('regn_nbr'); ?></span>
                        </div>
                    </div>
                    <!--<div class="control-group<?php echo form_error('image') ? ' error' : ''; ?>">
                        <?php echo form_label(lang('profile_field_image'), 'image', array('class' => 'control-label')); ?>
                        <div class='controls'>
                            <?php if(isset($profile->image)) : ?>
                                <?php echo(isset($profile->image) ? anchor(base_url() . 'uploads/' . unserialize($profile->image)['file_name'], unserialize($profile->image)['file_name']) : ''); ?>
                            <?php endif;?>
                            <input id='image' type='file' name='image' tabindex='13'/>
                            <span class='help-inline'><?php echo form_error('image'); ?></span>
                        </div>
                    </div>-->
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('profile_action_create'); ?>" tabindex='14'/>
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/profile', lang('profile_cancel'), 'class="btn btn-warning"', "tabindex='15'"); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>