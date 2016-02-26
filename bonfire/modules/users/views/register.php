<?php

$errorClass   = empty($errorClass) ? ' error' : $errorClass;

?>
<style scoped='scoped'>
#register p.already-registered {
    text-align: center;
}
</style>
<?php
/*
if (validation_errors()) :
?>
<div class='alert alert-danger fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('us_registration_fail'); ?>
    </h4>
</div>
<?php endif; 
*/
?>
<?php echo form_open(site_url(REGISTER_URL), array('class' => "form-horizontal", 'autocomplete' => 'off')); ?>

<div class="row">
    <hr/><h3>Sign up</h3>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group<?php echo form_error('email') ? $errorClass : ''; ?>">
            <label class="control-label required" for="email"><?php echo lang('bf_email') . lang('bf_form_label_required') ; ?></label>
            <input type="text" id="email" name="email" class="form-control" value="<?php echo set_value('email', isset($user) ? $user->email : ''); ?>" />
            <span class="help-inline"><?php echo form_error('email'); ?></span>
        </div>
        <div class="form-group<?php echo form_error('display_name') ? $errorClass : ''; ?>">
            <label class="control-label" for="display_name"><?php echo lang('bf_display_name'); ?></label>
            <div class="controls">
                <input class="form-control" type="text" id="display_name" name="display_name" value="<?php echo set_value('display_name', isset($user) ? $user->display_name : ''); ?>" />
                <span class="help-inline"><?php echo form_error('display_name'); ?></span>
            </div>
        </div>
        <?php if (settings_item('auth.login_type') !== 'email' || settings_item('auth.use_usernames')) : ?>
        <div class="form-group<?php echo form_error('username') ? $errorClass : ''; ?>">
            <label class="control-label required" for="username"><?php echo lang('bf_username'); ?></label>
            <div class="controls">
                <input class="form-control" type="text" id="username" name="username" value="<?php echo set_value('username', isset($user) ? $user->username : ''); ?>" />
                <span class="help-inline"><?php echo form_error('username'); ?></span>
            </div>
        </div>
        <?php endif; ?>
        <div class="form-group<?php echo form_error('password') ? $errorClass : ''; ?>">
            <label class="control-label" for="password"><?php echo lang('bf_password') . lang('bf_form_label_required') ; ?></label>
            <div class="controls">
                <input class="form-control" type="password" id="password" name="password" value="" />
                <span class="help-inline"><?php echo form_error('password'); ?></span>
            </div>
        </div>
        <div class="form-group<?php echo form_error('pass_confirm') ? $errorClass : ''; ?>">
            <label class="control-label" for="pass_confirm">Confirm Password*</label>
            <div class="controls">
                <input class="form-control" type="password" id="pass_confirm" name="pass_confirm" value="" />
                <span class="help-inline"><?php echo form_error('pass_confirm'); ?></span>
            </div>
        </div>
        <div class="form-group">
            <?php
            // Allow modules to render custom fields. No payload is passed
            // since the user has not been created, yet.
            Events::trigger('render_user_form');
            ?>
            <!-- Start of User Meta -->
            <?php $this->load->view('users/user_meta', array('frontend_only' => true)); ?>
            <!-- End of User Meta -->
        </div>
        <div class="form-group">
            <input tabindex='6' type='submit' name='register' class='btn btn-primary' value="<?php echo lang('us_register'); ?>" />
        </div>            
    </div>

<?php echo form_close(); ?>
