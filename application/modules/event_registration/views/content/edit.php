<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('event_registration_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($event_registration->id) ? $event_registration->id : '';

?>
<div class='admin-box'>
    <h3>Event Registration</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            
			<?php 
                if (is_array($games_select) && count($games_select)) :
				    echo form_dropdown('event_id', $games_select, set_value('event_id', isset($event_registration->event_id) ? $event_registration->event_id : ''), 'Event'. lang('bf_form_label_required'), "tabindex='1'");
                endif;
			?>

            <div class="control-group<?php echo form_error('category') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_category') . lang('bf_form_label_required'), 'category', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='category' type='text' tabindex='2' required='required' name='category'  value="<?php echo set_value('category', isset($event_registration->category) ? $event_registration->category : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('category'); ?></span>
                </div>
            </div>

			<?php 
                if (is_array($teams_select) && count($teams_select)) :
				    echo form_dropdown('member_id', $teams_select, set_value('member_id', isset($event_registration->member_id) ? $event_registration->member_id : ''), 'Team Member', "tabindex='3'");
                endif;
			?>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_registration_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('tabindex'=>'4', 'name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($event_registration->comments) ? $event_registration->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('event_registration_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/event_registration', lang('event_registration_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('Event_Registration.Content.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('event_registration_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('event_registration_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>