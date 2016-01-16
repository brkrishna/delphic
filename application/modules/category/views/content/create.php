<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('category_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($category->id) ? $category->id : '';

?>
<div class='admin-box'>
    <h3>Category</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_code'), 'code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='code' type='text' name='code' maxlength='255' value="<?php echo set_value('code', isset($category->code) ? $category->code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('desc') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_desc') . lang('bf_form_label_required'), 'desc', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='desc' type='text' required='required' name='desc' maxlength='255' value="<?php echo set_value('desc', isset($category->desc) ? $category->desc : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('desc'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($category->comments) ? $category->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('sort_order') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_sort_order') . lang('bf_form_label_required'), 'sort_order', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sort_order' type='text' required='required' name='sort_order' maxlength='5' value="<?php echo set_value('sort_order', isset($category->sort_order) ? $category->sort_order : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sort_order'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('category_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/category', lang('category_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>