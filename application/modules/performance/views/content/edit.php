<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('performance_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($performance->id) ? $performance->id : '';

?>
<div class='admin-box'>
    <h3>Performance</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('performance_field_code') . lang('bf_form_label_required'), 'code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='code' type='text' required='required' name='code' maxlength='255' value="<?php echo set_value('code', isset($performance->code) ? $performance->code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('desc') ? ' error' : ''; ?>">
                <?php echo form_label(lang('performance_field_desc') . lang('bf_form_label_required'), 'desc', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='desc' type='text' required='required' name='desc' maxlength='255' value="<?php echo set_value('desc', isset($performance->desc) ? $performance->desc : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('desc'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('performance_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($performance->comments) ? $performance->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('sort_order') ? ' error' : ''; ?>">
                <?php echo form_label(lang('performance_field_sort_order') . lang('bf_form_label_required'), 'sort_order', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sort_order' type='text' required='required' name='sort_order' maxlength='5' value="<?php echo set_value('sort_order', isset($performance->sort_order) ? $performance->sort_order : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sort_order'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('performance_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/performance', lang('performance_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Performance.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('performance_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('performance_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>