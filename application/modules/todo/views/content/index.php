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

$num_columns	= 16;
$can_delete	= $this->auth->has_permission('ToDo.Content.Delete');
$can_edit		= $this->auth->has_permission('ToDo.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}


?>
<div class='admin-box'>
    <button class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample">
        Add
    </button>
    <div class="collapse" id="collapseExample">
        <?php echo form_open($this->uri->uri_string() . '/create', 'class="ajax-form form-inline"'); ?>
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
                <input type='submit' name='save' class='ajaxify btn btn-primary' value="<?php echo lang('todo_action_create'); ?>" />
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(SITE_AREA . '/content/todo', lang('todo_cancel'), 'class="btn btn-warning"'); ?>
                
            </fieldset>
        <?php echo form_close(); ?>        
    </div>
    <?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('todo_field_notes'); ?>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('todo_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/content/todo/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->notes); ?></td>
				<?php else : ?>
					<td><?php e($record->notes); ?></td>
				<?php endif; ?>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('todo_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
	
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>    
