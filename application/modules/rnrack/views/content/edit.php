<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('rnrack_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($rnrack->id) ? $rnrack->id : '';

?>
<div class='admin-box'>
    <h3>rnrack</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('profile') ? ' error' : ''; ?>">
                <?php echo form_label(lang('rnrack_field_profile'), 'profile', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='profile' type='text' name='profile'  value="<?php echo set_value('profile', isset($rnrack->profile) ? $rnrack->profile : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('profile'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('rnrack_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/rnrack', lang('rnrack_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Rnrack.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('rnrack_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('rnrack_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>