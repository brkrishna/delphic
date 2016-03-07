<?php
if (validation_errors()) :
?>
<div class='alert alert-danger fade in'>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script  type="text/javascript">
    $(document).ready(function(){

        var ent_type = $("input[name='entity_type']:checked").val();
        if (ent_type == 'Individual'){
            $("#regn_nbr").prop('readonly', true);
            $("#entity_name").prop('readonly', true);
        }else{
            $("#regn_nbr").prop('readonly', false);
            $("#entity_name").prop('readonly', false);
        }

        $("input[name='entity_type']:radio").change(function(){
            var ent_type = $(this).val();
            if(ent_type == 'Individual'){
                $("#entity_name").val("NA");
                $("#entity_name").prop('readonly', true);
                $("#regn_nbr").prop('readonly', true);
            }else{
                $("#entity_name").val("");
                $("#entity_name").prop('readonly', false);
                $("#regn_nbr").prop('readonly', false);
            }        
        });
    });
</script>

<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal'); ?>
<div class="row">
    <hr/>
    <h4>Profile</h4>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">
                    <input type="radio" id="entity_type_i" name="entity_type" value="Individual" 
                    <?php echo (isset($profile->entity_type) && $profile->entity_type == 'Individual' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Individual</label>
                <span class="input-group-addon">
                    <input type="radio" id="entity_type_o" name="entity_type" value="Organization" 
                    <?php echo (isset($profile->entity_type) && $profile->entity_type == 'Organization' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Organization</label>
            </div>
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
        <div class="form-group<?php echo form_error('contact_m_name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_contact_m_name'), 'contact_m_name', array('class' => 'control-label')); ?>
            <input tabindex='5' id='contact_m_name' class="form-control" type='text' required='required' name='contact_m_name' maxlength='255' value="<?php echo set_value('contact_m_name', isset($profile->contact_m_name) ? $profile->contact_m_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_m_name'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('contact_last_name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_contact_last_name'), 'contact_last_name', array('class' => 'control-label')); ?>
            <input tabindex='5' id='contact_last_name' class="form-control" type='text' required='required' name='contact_last_name' maxlength='255' value="<?php echo set_value('contact_last_name', isset($profile->contact_last_name) ? $profile->contact_last_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_last_name'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('contact_number') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_contact_number') . lang('bf_form_label_required'), 'contact_number', array('class' => 'control-label')); ?>
            <input tabindex='6' class="form-control" id='contact_number' type='text' required='required' name='contact_number' placeholder="919849112345" maxlength='50' value="<?php echo set_value('contact_number', isset($profile->contact_number) ? $profile->contact_number : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_number'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('alt_contact_number') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_alt_contact_number'), 'alt_contact_number', array('class' => 'control-label')); ?>
            <input tabindex='7' class="form-control" id='alt_contact_number' type='text' name='alt_contact_number' placeholder="919849112345" maxlength='50' value="<?php echo set_value('alt_contact_number', isset($profile->alt_contact_number) ? $profile->alt_contact_number : ''); ?>" />
            <span class='help-inline'><?php echo form_error('alt_contact_number'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('email_id') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_email_id') . lang('bf_form_label_required'), 'email_id', array('class' => 'control-label')); ?>
            <input tabindex='8' class="form-control" id='email_id' type='text' required='required' name='email_id' placeholder="myname@example.com" maxlength='255' value="<?php echo set_value('email_id', isset($profile->email_id) ? $profile->email_id : ''); ?>" />
            <span class='help-inline'><?php echo form_error('email_id'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('address') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_address'), 'address', array('class' => 'control-label')); ?>
            <input tabindex='9' class="form-control" id='address' type='text' required='required' name='address' maxlength='255' value="<?php echo set_value('address', isset($profile->address) ? $profile->address : ''); ?>" />
            <span class='help-inline'><?php echo form_error('address'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('city') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_city') . lang('bf_form_label_required'), 'city', array('class' => 'control-label')); ?>
            <input tabindex='10' class="form-control" id='city' type='text' required='required' name='city' maxlength='255' value="<?php echo set_value('city', isset($profile->city) ? $profile->city : ''); ?>" />
            <span class='help-inline'><?php echo form_error('city'); ?></span>
        </div>
        <div class="form-group">
        <?php 
            if (is_array($countries_select) && count($countries_select)) :
                echo form_dropdown(array('name' => 'country', 'class'=>'form-control', 'tabindex'=>'11'), $countries_select, set_value('country', isset($profile->country) ? $profile->country : ''), 'Country'. lang('bf_form_label_required'));
            endif;
        ?>
        </div>
        <div class="form-group<?php echo form_error('post_code') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_post_code'), 'post_code', array('class' => 'control-label')); ?>
            <input tabindex='12' class="form-control" id='post_code' type='text' name='post_code' maxlength='11' value="<?php echo set_value('post_code', isset($profile->post_code) ? $profile->post_code : ''); ?>" />
            <span class='help-inline'><?php echo form_error('post_code'); ?></span>
        </div>
        
        <div class="form-group<?php echo form_error('profile') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_profile') . lang('bf_form_label_required'), 'profile', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'name' => 'profile', 'id' => 'profile', 'rows' => '8', 'cols' => '80', 'tabindex'=>'13', 'value' => set_value('profile', isset($profile->profile) ? $profile->profile : ''))); ?>
            <span class='help-inline'><?php echo form_error('profile'); ?></span>
        </div>
        <!--
        <div class="form-group<?php echo form_error('addl_info') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_addl_info'), 'addl_info', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'name' => 'addl_info', 'id' => 'addl_info', 'rows' => '8', 'cols' => '80',  'tabindex'=>'14', 'value' => set_value('addl_info', isset($profile->addl_info) ? $profile->addl_info : ''))); ?>
            <span class='help-inline'><?php echo form_error('addl_info'); ?></span>
        </div>-->
        <!--
        <?php if(isset($profile->image)) : ?>
            <?php echo(isset($profile->image) ? anchor(base_url() . 'uploads/' . unserialize($profile->image)['file_name'], unserialize($profile->image)['file_name']) : ''); ?>
        <?php endif; ?>
        <div class="form-group<?php echo form_error('image') ? ' error' : ''; ?>">
            <?php echo form_label(lang('profile_field_image'), 'image', array('class' => 'control-label')); ?>
            <div class='controls'>
                <input class="btn btn-primary" id='image' type='file' name='image' maxlength='4000' value="<?php echo set_value('image', isset($profile->image) ? $profile->image : ''); ?>" />
                <span class='help-inline'><?php echo form_error('image'); ?></span>
            </div>
        </div>
        <br/>-->
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="well well-lg">
            <p class="text-justify">
                <h2>What is this Profile for?</h2>
                <hr/>
                A Group, Sponsoring Organization or a Country representing an individual or a team creates their profile, which acts as a single point of contact and represents the team for the 5th Youth Delphic Games.
                <br/><br/>
                Note: If you are registering as an Individual, Name of the Organization and Registration Number of the Organization is not applicable
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6">
        <div class="form-group">
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('profile_action_create'); ?>" tabindex='15'/>
            <?php echo lang('bf_or'); ?>
            <?php if(isset($profile->id)) : ?>
            <?php echo anchor(base_url() . 'index.php/admin/content/team/create', lang('profile_action_create_team'), array('class'=>'btn btn-primary', 'tabindex'=>'16')); ?> 
            <?php echo lang('bf_or'); ?>
            <?php endif; ?>    
            <?php echo anchor(base_url(), lang('profile_cancel'), 'class="btn btn-warning"', "tabindex='17'"); ?>
        </div>
    </div>
</div>    
<?php echo form_close(); ?>
