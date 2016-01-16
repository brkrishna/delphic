<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('profile_users_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($profile_users->id) ? $profile_users->id : '';

?>
<div class='admin-box'>
    <h3>Profile Users</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                );
                echo form_dropdown(array('name' => 'profile_id', 'required' => 'required'), $options, set_value('profile_id', isset($profile_users->profile_id) ? $profile_users->profile_id : ''), lang('profile_users_field_profile_id') . lang('bf_form_label_required'));
            ?>

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                );
                echo form_dropdown(array('name' => 'user_id', 'required' => 'required'), $options, set_value('user_id', isset($profile_users->user_id) ? $profile_users->user_id : ''), lang('profile_users_field_user_id') . lang('bf_form_label_required'));
            ?>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('profile_users_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/profile_users', lang('profile_users_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Profile_Users.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('profile_users_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('profile_users_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>