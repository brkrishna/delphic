<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('todo_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($todo->id) ? $todo->id : '';

?>
<div class='admin-box'>
    <h3>ToDo</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('notes') ? ' error' : ''; ?>">
                <?php echo form_label(lang('todo_field_notes') . lang('bf_form_label_required'), 'notes', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='notes' type='text' required='required' name='notes' maxlength='255' value="<?php echo set_value('notes', isset($todo->notes) ? $todo->notes : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('notes'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('todo_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/todo', lang('todo_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('ToDo.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('todo_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('todo_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>