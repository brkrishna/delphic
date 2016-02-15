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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script  type="text/javascript">
    $(document).ready(function(){

        var mem_type = $("input[name='member_type']:checked").val();
        if (mem_type == 'Indian Citizen'){
            $("#passport_nbr").prop('readonly', true);
            $("#place_of_issue").prop('readonly', true);
            $("#date_of_issue").prop('readonly', true);
            $("#date_of_expiry").prop('readonly', true);

            $("#attachment_type").prop('readonly', false);
            $("#attachment").prop('readonly', false);

        }else{
            $("#passport_nbr").prop('readonly', false);
            $("#place_of_issue").prop('readonly', false);
            $("#date_of_issue").prop('readonly', false);
            $("#date_of_expiry").prop('readonly', false);

            $("#attachment_type").prop('readonly', true);
            $("#attachment").prop('readonly', true);

        }

        $("input[name='member_type']:radio").change(function(){
            var mem_type = $(this).val();
            if (mem_type == 'Indian Citizen'){
                $("#passport_nbr").prop('readonly', true);
                $("#place_of_issue").prop('readonly', true);
                $("#date_of_issue").prop('readonly', true);
                $("#date_of_expiry").prop('readonly', true);

                $("#attachment_type").val('-1');
                $("#attachment_type").prop('disabled', false);
                $("#attachment").prop('readonly', false);

            }else{
                $("#passport_nbr").prop('readonly', false);
                $("#place_of_issue").prop('readonly', false);
                $("#date_of_issue").prop('readonly', false);
                $("#date_of_expiry").prop('readonly', false);

                $("#attachment_type option:contains('Other')").attr('selected', 'selected');
                $("#attachment_type").prop('disabled', true);
                $("#attachment").prop('readonly', true);

            }
        });
    });
</script>

<?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
<div class="row">
    <hr/>
    <h4>Team Member</h4>
    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" tabindex="1">
                    <input type="radio" id="member_type_ic" required name="member_type" value="Indian Citizen" 
                    <?php echo (isset($team->member_type) && $team->member_type == 'Indian Citizen' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Indian Citizen</label>
                <span class="input-group-addon">
                    <input type="radio" id="member_type_ip" name="member_type" value="International Participant" 
                    <?php echo (isset($team->member_type) && $team->member_type == 'International Participant' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">International Participant</label>
            </div>
        </div>

        <div class="form-group<?php echo form_error('name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_name') . lang('bf_form_label_required'), 'name', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='2' id='name' type='text' required name='name' maxlength='255' value="<?php echo set_value('name', isset($team->name) ? $team->name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('name'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('last_name') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_last_name') . lang('bf_form_label_required'), 'last_name', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='3' id='name' type='text' required name='last_name' maxlength='255' value="<?php echo set_value('last_name', isset($team->last_name) ? $team->last_name : ''); ?>" />
            <span class='help-inline'><?php echo form_error('last_name'); ?></span>
        </div>
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon" tabindex="4">
                    <input type="radio" id="gender_m" required name="gender" value="Male" 
                    <?php echo (isset($team->gender) && $team->gender == 'Male' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Male</label>
                <span class="input-group-addon">
                    <input type="radio" id="gender_f" name="gender" value="Female" 
                    <?php echo (isset($team->gender) && $team->gender == 'Female' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Female</label>
                <span class="input-group-addon">
                    <input type="radio" id="gender_o" name="gender" value="Others" 
                    <?php echo (isset($team->gender) && $team->gender == 'Others' ? 'checked="true"' : ''); ?> />
                </span>
                <label class="form-control">Others</label>
            </div>
        </div>
        <div class="form-group<?php echo form_error('dob') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_dob') . lang('bf_form_label_required'), 'dob', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='5' id='dob' type='text' required name='dob' placeholder="YYYY-MM-DD" maxlength='255' value="<?php echo set_value('dob', isset($team->dob) ? $team->dob : ''); ?>" tabindex='4' />
            <span class='help-inline'><?php echo form_error('dob'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('contact_nbr') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_contact_nbr') . lang('bf_form_label_required'), 'contact_nbr', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='6' id='contact_nbr' required type='text' name='contact_nbr' placeholder="919849112345" maxlength='255' value="<?php echo set_value('contact_nbr', isset($team->contact_nbr) ? $team->contact_nbr : ''); ?>" />
            <span class='help-inline'><?php echo form_error('contact_nbr'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('alt_contact_nbr') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_alt_contact_nbr'), 'alt_contact_nbr', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='7' id='alt_contact_nbr' type='text' name='alt_contact_nbr' placeholder="919849112345" maxlength='50' value="<?php echo set_value('alt_contact_nbr', isset($team->alt_contact_nbr) ? $team->alt_contact_nbr : ''); ?>" />
            <span class='help-inline'><?php echo form_error('alt_contact_nbr'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('email') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_email') . lang('bf_form_label_required'), 'email', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='8' id='email' type='text' required name='email' maxlength='255' placeholder="myname@example.com" value="<?php echo set_value('email', isset($team->email) ? $team->email : ''); ?>" />
            <span class='help-inline'><?php echo form_error('email'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('profession') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_profession') . lang('bf_form_label_required'), 'profession', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='9' id='profession' type='text' required name='profession' maxlength='255' value="<?php echo set_value('profession', isset($team->profession) ? $team->profession : ''); ?>" />
            <span class='help-inline'><?php echo form_error('profession'); ?></span>
        </div>
        <h5>Passport Details&nbsp;<small>Required for International Participants</small></h5>
        <hr/>    
        <div class="form-group<?php echo form_error('passport_nbr') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_passport_nbr'), 'passport_nbr', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='10' id='passport_nbr' type='text' name='passport_nbr' maxlength='255' value="<?php echo set_value('passport_nbr', isset($team->passport_nbr) ? $team->passport_nbr : ''); ?>" />
            <span class='help-inline'><?php echo form_error('passport_nbr'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('place_of_issue') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_place_of_issue'), 'place_of_issue', array('class' => 'control-label')); ?>
            <input class="form-control" tabindex='11' id='place_of_issue' type='text' name='place_of_issue' maxlength='255' value="<?php echo set_value('place_of_issue', isset($team->place_of_issue) ? $team->place_of_issue : ''); ?>" />
            <span class='help-inline'><?php echo form_error('place_of_issue'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('date_of_issue') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_date_of_issue'), 'date_of_issue', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='12' id='date_of_issue' type='text' placeholder="YYYY-MM-DD" name='date_of_issue'  value="<?php echo set_value('date_of_issue', isset($team->date_of_issue) ? $team->date_of_issue : ''); ?>" />
            <span class='help-inline'><?php echo form_error('date_of_issue'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('date_of_expiry') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_date_of_expiry'), 'date_of_expiry', array('class' => 'control-label')); ?>
            <input class='form-control' tabindex='13' id='date_of_expiry' type='text' placeholder="YYYY-MM-DD" name='date_of_expiry'  value="<?php echo set_value('date_of_expiry', isset($team->date_of_expiry) ? $team->date_of_expiry : ''); ?>" />
            <span class='help-inline'><?php echo form_error('date_of_expiry'); ?></span>
        </div>
        <hr/>
        <h5>Identify Proof details&nbsp;<small>Required for Indian Citizens</small></h5>
        <hr/>    
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
            echo form_dropdown(array('name' => 'attachment_type', 'class'=>'form-control', 'required'=> '', 'tabindex'=>'14', ), $options, set_value('attachment_type', isset($team->attachment_type) ? $team->attachment_type : ''), lang('team_field_attachment_type') . lang('bf_form_label_required') );
        ?>
        </div>
        <div class="form-group<?php echo form_error('attachment') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_attachment') . lang('bf_form_label_required'), 'attachment', array('class' => 'control-label')); ?>
            <?php if(isset($team->attachment)) : ?>
                <?php echo(isset($team->attachment) ? anchor(base_url() . 'uploads/' . unserialize($team->attachment)['file_name'], unserialize($team->attachment)['file_name']) : ''); ?>
            <?php endif; ?>
            <input class="btn btn-primary" tabindex='15' id='attachment' type='file' name='attachment' maxlength='4000' value="<?php echo set_value('attachment', isset($team->attachment) ? $team->attachment : ''); ?>" />
            <span class='help-inline'><?php echo form_error('attachment'); ?></span>
            <span class='help-inline'>File formats suppported : PDF, JPG, JPEG, GIF, PNG</span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-8">
        <div class="well well-lg">
            <p class="text-justify">
                <h2>What is this Team?</h2>
                <hr/>
                If you are a group of performers, you will create entries for each team member here. Once added, you can map these team members as participants for various events
                <br/><br/>
                For contact number and alternate contact number, please specify only digits with ISD code where applicable 
                <br/><br/>
                Please enter the dates in YYYY-MM-DD format, optionally you can select the date from calendar as well
                <br/><br/>
                Note: For International Participants, passport details are mandatory
                <br/><br/>
                Some house keeping checks with passport
                <ul>    
                    <li>Should be valid and legible</li>
                    <li>Passport should have been issued at least 3 months earlier</li>
                    <li>Passport Expiry date should be more than 6 months from the stipulated travel time</li>
                </ul>
            </p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-10">
        <div class="form-group<?php echo form_error('profile') ? ' error' : ''; ?>">
            <?php echo form_label(lang('team_field_profile'), 'profile', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'tabindex'=>'16', 'name' => 'profile', 'id' => 'profile', 'rows' => '5', 'cols' => '80', 'value' => set_value('profile', isset($team->profile) ? $team->profile : ''))); ?>
            <span class='help-inline'><?php echo form_error('profile'); ?></span>
        </div>       
        <div class="form-group">
            <input tabindex='17' type='submit' name='save' class='btn btn-primary' value="<?php echo lang('team_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <input tabindex='18' type='submit' name='saveanother' class='btn btn-primary' value="<?php echo lang('team_action_create_another'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php if(isset($team->id)) : ?>
            <?php echo anchor(base_url() . 'index.php/admin/content/registration/create', lang('team_action_create_event'), array('class'=>'btn btn-primary', 'tabindex'=>'19')); ?> 
            <?php echo lang('bf_or'); ?>
            <?php endif; ?>
            <?php echo anchor(SITE_AREA . '/content/team', lang('team_cancel'), array('class'=>'btn btn-warning', 'tabindex'=>'20')); ?>
        </div>            
    </div>
</div>

<?php echo form_close(); ?>
