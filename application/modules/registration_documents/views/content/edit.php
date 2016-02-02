<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('registration_documents_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($registration_documents->id) ? $registration_documents->id : '';

?>
<div class="row-fluid">
    <ul class="nav nav-pills">
        <?php echo Modules::run('profile/profile_status'); ?>
    </ul>
</div>
<div class="row-fluid">
    <h4>Registration Documents</h4><br/>
    <?php echo form_open_multipart($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            <div class="control-group<?php echo form_error('registration') ? ' error' : ''; ?>">
                <div class='controls'>
                    <input id='registration' type='hidden' name='registration' value="<?php echo set_value('registration', isset($registration_documents->registration) ? $registration_documents->registration : $registration_nbr ); ?>" />
                    <span class='help-inline'><?php echo form_error('registration'); ?></span>
                </div>
            </div>
            <?php if(isset($registration_documents->attachment)) : ?>
                <?php echo(isset($registration_documents->attachment) ? anchor(base_url() . 'uploads/' . unserialize($registration_documents->attachment)['file_name'], unserialize($registration_documents->attachment)['file_name']) : ''); ?>
            <?php endif; ?>
            
            <div class="control-group<?php echo form_error('attachment') ? ' error' : ''; ?>">
                <?php echo form_label(lang('registration_documents_field_attachment'), 'attachment', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input class="btn btn-primary" id='attachment' type='file' name='attachment' maxlength='4000' value="<?php echo set_value('attachment', isset($registration_documents->attachment) ? $registration_documents->attachment : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('attachment'); ?></span>
                </div>
            </div>
            <br/>
            <div class="control-group<?php echo form_error('title') ? ' error' : ''; ?>">
                <div class='controls'>
                    <input id='title' type='text' name='title' value="<?php echo set_value('title', isset($registration_documents->title) ? $registration_documents->title : '' ); ?>" />
                    <span class='help-inline'><?php echo form_error('title'); ?></span>
                </div>
            </div>
            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('registration_documents_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($registration_documents->comments) ? $registration_documents->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('registration_documents_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/registration_documents/create/' . $registration_nbr, lang('registration_documents_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
    <br/>
    <?php
    
    $num_columns	= 7;
    $can_delete	= $this->auth->has_permission('Registration_Documents.Content.Delete');
    $can_edit		= $this->auth->has_permission('Registration_Documents.Content.Edit');
    $has_records	= isset($records) && is_array($records) && count($records);
    
    if ($can_delete) {
        $num_columns++;
    }
    ?>
	<h3>
		<?php echo lang('registration_documents_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					<th>Edit</th>
					<th><?php echo lang('registration_documents_field_attachment'); ?></th>
					<th><?php echo lang('registration_documents_field_comments'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('registration_documents_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/registration_documents/edit/' . $record->id, '<span class="icon-pencil"></span> Edit'); ?></td>
				<?php else : ?>
					<td>&nbsp;</td>
				<?php endif; ?>
					<td><?php echo(isset($record->attachment) ? anchor(base_url() . 'uploads/' . unserialize($record->attachment)['file_name'], $record->title) : ''); ?></td>
					<td><?php e($record->comments); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('registration_documents_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    ?>
</div>