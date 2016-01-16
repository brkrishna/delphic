<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('games_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($games->id) ? $games->id : '';

?>
<div class='admin-box'>
    <h3>Games</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('name') ? ' error' : ''; ?>">
                <?php echo form_label(lang('games_field_name') . lang('bf_form_label_required'), 'name', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='name' type='text' required='required' name='name' maxlength='255' value="<?php echo set_value('name', isset($games->name) ? $games->name : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('name'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('category') ? ' error' : ''; ?>">
                <?php echo form_label(lang('games_field_category') . lang('bf_form_label_required'), 'category', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='category' type='text' required='required' name='category' maxlength='255' value="<?php echo set_value('category', isset($games->category) ? $games->category : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('category'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('sub_category') ? ' error' : ''; ?>">
                <?php echo form_label(lang('games_field_sub_category'), 'sub_category', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sub_category' type='text' name='sub_category' maxlength='255' value="<?php echo set_value('sub_category', isset($games->sub_category) ? $games->sub_category : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sub_category'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('desc') ? ' error' : ''; ?>">
                <?php echo form_label(lang('games_field_desc') . lang('bf_form_label_required'), 'desc', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'desc', 'id' => 'desc', 'rows' => '5', 'cols' => '80', 'value' => set_value('desc', isset($games->desc) ? $games->desc : ''), 'required' => 'required')); ?>
                    <span class='help-inline'><?php echo form_error('desc'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('games_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/games', lang('games_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Games.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('games_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('games_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>