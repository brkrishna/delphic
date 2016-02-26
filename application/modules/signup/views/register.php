<?php

if (validation_errors()) :
?>
<div class='alert alert-error fade in'>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script  type="text/javascript">

</script>

<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
<div class='row'> 
    <hr/>
    <h3>Signup</h3>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo form_label(lang('signup_field_first_name') . lang('bf_form_label_required'), 'first_name', array('class' => 'control-label')); ?>
            <input class="form-control" id='first_name' type='text' required='required' name='first_name' maxlength='255' value="<?php echo set_value('first_name', isset($signup->first_name) ? $signup->first_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('first_name'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_middle_name'), 'middle_name', array('class' => 'control-label')); ?>
            <input class="form-control" id='middle_name' type='text' name='middle_name' maxlength='255' value="<?php echo set_value('middle_name', isset($signup->middle_name) ? $signup->middle_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('middle_name'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_last_name') . lang('bf_form_label_required'), 'last_name', array('class' => 'control-label')); ?>
            <input class="form-control" id='last_name' type='text' required='required' name='last_name' maxlength='255' value="<?php echo set_value('last_name', isset($signup->last_name) ? $signup->last_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('last_name'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
            <input class="form-control" id='email_id' type='text' required='required' name='email_id' maxlength='255' value="<?php echo set_value('email_id', isset($signup->email_id) ? $signup->email_id : ''); ?>" />
            <span class='help-inline'><?php echo form_error('email_id'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_password') . lang('bf_form_label_required'), 'password', array('class' => 'control-label')); ?>
            <input class="form-control" id='password' type='text' required='required' name='password' maxlength='255' value="<?php echo set_value('password', isset($signup->password) ? $signup->password : ''); ?>" />
            <span class='help-inline'><?php echo form_error('password'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_conf_password') . lang('bf_form_label_required'), 'conf_password', array('class' => 'control-label')); ?>
            <input class="form-control" id='conf_password' type='text' required='required' name='conf_password' maxlength='255' />
            <span class='help-inline'><?php echo form_error('conf_password'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_mobile') . lang('bf_form_label_required'), 'mobile', array('class' => 'control-label')); ?>
            <input class="form-control" id='mobile' type='text' required='required' name='mobile' maxlength='255' value="<?php echo set_value('mobile', isset($signup->mobile) ? $signup->mobile : ''); ?>" />
            <span class='help-inline'><?php echo form_error('mobile'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_address') . lang('bf_form_label_required'), 'address', array('class' => 'control-label')); ?>
            <input class="form-control" id='address' type='text' required='required' name='address' maxlength='255' value="<?php echo set_value('address', isset($signup->address) ? $signup->address : ''); ?>" />
            <span class='help-inline'><?php echo form_error('address'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
            <input class="form-control" id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($signup->city) ? $signup->city : ''); ?>" />
            <span class='help-inline'><?php echo form_error('city'); ?></span>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_post_code') . lang('bf_form_label_required'), 'post_code', array('class' => 'control-label')); ?>
            <input class="form-control" id='post_code' type='text' required='required' name='post_code' maxlength='50' value="<?php echo set_value('post_code', isset($signup->post_code) ? $signup->post_code : ''); ?>" />
            <span class='help-inline'><?php echo form_error('post_code'); ?></span>
        </div>
        <div class="form-group">
        <?php 
            if (is_array($countries_select) && count($countries_select)) :
                echo form_dropdown(array('name' => 'country', 'class'=>'form-control', 'tabindex'=>'11'), $countries_select, set_value('country', isset($signup->country) ? $signup->country : ''), 'Country'. lang('bf_form_label_required'));
            endif;
        ?>
        </div>
        <div class="form-group">
            <?php echo form_label(lang('signup_field_dob') . lang('bf_form_label_required'), 'dob', array('class' => 'control-label')); ?>
            <input class="form-control" id='dob' type='text' required='required' name='dob' maxlength='10' value="<?php echo set_value('dob', isset($signup->dob) ? $signup->dob : ''); ?>" />
            <span class='help-inline'><?php echo form_error('dob'); ?></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" tabindex="4">
                    <input checked="true" type="radio" id="gender_m" required name="gender" value="Male" 
                    <?php echo (isset($signup->gender) && $signup->gender == 'Male' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Male</label>
                <span class="input-group-addon">
                    <input type="radio" id="gender_f" name="gender" value="Female" 
                    <?php echo (isset($signup->gender) && $signup->gender == 'Female' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Female</label>
                <span class="input-group-addon">
                    <input type="radio" id="gender_o" name="gender" value="Others" 
                    <?php echo (isset($signup->gender) && $signup->gender == 'Others' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Others</label>
            </div>
        </div>
        <hr/>
        Participation Detials
        <hr/>
        <div class="form-group">
            You want to participate in the YDG ‘16 as a:    
            <div class="input-group">
                <span class="input-group-addon" tabindex="5">
                    <input checked="true" type="radio" id="mode" required name="mode" value="Competitor" 
                    <?php echo (isset($signup->mode) && $signup->mode == 'Competitor' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Competitor</label>
                <span class="input-group-addon">
                    <input type="radio" id="mode_f" name="mode" value="Exhibitor" 
                    <?php echo (isset($signup->mode) && $signup->mode == 'Exhibitor' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Exhibitor</label>
                <span class="input-group-addon">
                    <input type="radio" id="mode_o" name="mode" value="Performer" 
                    <?php echo (isset($signup->mode) && $signup->mode == 'Performer' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Performer</label>
            </div>
        </div>
        <div class="form-group">
            Are you signing up as a:    
            <div class="input-group">
                <span class="input-group-addon" tabindex="5">
                    <input checked="true" type="radio" id="representation_self" required name="representation" value="Participant" 
                    <?php echo (isset($signup->representation) && $signup->representation == 'Participant' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Participant</label>
                <span class="input-group-addon">
                    <input type="radio" id="representation_rep" name="representation" value="Representative" 
                    <?php echo (isset($signup->representation) && $signup->representation == 'Representative' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Representative</label>
            </div>
        </div>
        <div class="form-group">
            Are you an:     
            <div class="input-group">
                <span class="input-group-addon" tabindex="5">
                    <input checked="true" type="radio" id="team_i" required name="team" value="Individual" 
                    <?php echo (isset($signup->team) && $signup->team == 'Individual' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Individual</label>
                <span class="input-group-addon">
                    <input type="radio" id="team_g" name="team" value="Group" 
                    <?php echo (isset($signup->team) && $signup->team == 'Group' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Group</label>
                <span class="input-group-addon">
                    <input type="radio" id="team_m" name="team" value="Multiple Groups" 
                    <?php echo (isset($signup->team) && $signup->team == 'Multile Groups' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Multiple Groups</label>
            </div>
        </div>
        <div class="form-group">
            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    'Performance Arts'=>'Performance Arts',
                    'Musical Arts'=>'Musical Arts',
                );
                echo form_dropdown(array('name' => 'categories', 'required' => 'required', 'class'=> 'form-control', 'multiple'=>'multiple'), $options, set_value('categories', isset($signup->categories) ? $signup->categories : ''), lang('signup_field_categories') . lang('bf_form_label_required'));
            ?>
        </div>
        <div class="form-group">
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('signup_action_create'); ?>" />
            <!--
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/signup', lang('signup_cancel'), 'class="btn btn-warning"'); ?>-->
        </div>
    </div>
</div>
<?php echo form_close(); ?>
