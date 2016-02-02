<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('event_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($event->id) ? $event->id : '';

?>
<div class='admin-box'>
    <h3>Event</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
			<?php 
                if (is_array($categories_select) && count($categories_select)) :
				    echo form_dropdown('category', $categories_select, set_value('category', isset($event['category']) ? $event['category'] : ''), 'Category'. lang('bf_form_label_required'), "tabindex='1'");
                endif;
			?>
			<?php 
                if (is_array($style_select) && count($style_select)) :
				    echo form_dropdown('style', $style_select, set_value('style', isset($event['style']) ? $event['style'] : ''), 'Style'. lang('bf_form_label_required'), "tabindex='2'");
                endif;
			?>
			<?php 
                if (is_array($performance_select) && count($performance_select)) :
				    echo form_dropdown('performance', $performance_select, set_value('performance', isset($event['performance']) ? $event['performance'] : ''), 'Performance'. lang('bf_form_label_required'), "tabindex='3'");
                endif;
			?>
            <div class="control-group<?php echo form_error('sort_order') ? ' error' : ''; ?>">
                <?php echo form_label(lang('event_field_sort_order') . lang('bf_form_label_required'), 'sort_order', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sort_order' type='text' required='required' name='sort_order'  value="<?php echo set_value('sort_order', isset($event->sort_order) ? $event->sort_order : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sort_order'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('event_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/event', lang('event_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>