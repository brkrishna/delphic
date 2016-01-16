<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('sub_category_three_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($sub_category_three->id) ? $sub_category_three->id : '';

?>
<div class='admin-box'>
    <h3>Sub Category Three</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <?php // Change the values in this array to populate your dropdown as required
                $options = array(
                    255 => 255,
                );
                echo form_dropdown(array('name' => 'category', 'required' => 'required'), $options, set_value('category', isset($sub_category_three->category) ? $sub_category_three->category : ''), lang('sub_category_three_field_category') . lang('bf_form_label_required'));
            ?>

            <div class="control-group<?php echo form_error('code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sub_category_three_field_code') . lang('bf_form_label_required'), 'code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='code' type='text' required='required' name='code' maxlength='255' value="<?php echo set_value('code', isset($sub_category_three->code) ? $sub_category_three->code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('desc') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sub_category_three_field_desc') . lang('bf_form_label_required'), 'desc', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='desc' type='text' required='required' name='desc' maxlength='255' value="<?php echo set_value('desc', isset($sub_category_three->desc) ? $sub_category_three->desc : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('desc'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sub_category_three_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($sub_category_three->comments) ? $sub_category_three->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('sort_order') ? ' error' : ''; ?>">
                <?php echo form_label(lang('sub_category_three_field_sort_order') . lang('bf_form_label_required'), 'sort_order', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sort_order' type='text' required='required' name='sort_order' maxlength='5' value="<?php echo set_value('sort_order', isset($sub_category_three->sort_order) ? $sub_category_three->sort_order : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sort_order'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('sub_category_three_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/sub_category_three', lang('sub_category_three_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>