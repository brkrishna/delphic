<?php

$num_columns	= 19;
$can_delete	= $this->auth->has_permission('Signup.Content.Delete');
$can_edit		= $this->auth->has_permission('Signup.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('signup_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('signup_field_first_name'); ?></th>
					<th><?php echo lang('signup_field_middle_name'); ?></th>
					<th><?php echo lang('signup_field_last_name'); ?></th>
					<th><?php echo lang('signup_field_email_id'); ?></th>
					<th><?php echo lang('signup_field_password'); ?></th>
					<th><?php echo lang('signup_field_mobile'); ?></th>
					<th><?php echo lang('signup_field_address'); ?></th>
					<th><?php echo lang('signup_field_city'); ?></th>
					<th><?php echo lang('signup_field_post_code'); ?></th>
					<th><?php echo lang('signup_field_country'); ?></th>
					<th><?php echo lang('signup_field_dob'); ?></th>
					<th><?php echo lang('signup_field_gender'); ?></th>
					<th><?php echo lang('signup_field_mode'); ?></th>
					<th><?php echo lang('signup_field_representation'); ?></th>
					<th><?php echo lang('signup_field_team'); ?></th>
					<th><?php echo lang('signup_field_categories'); ?></th>
					<th><?php echo lang('signup_column_deleted'); ?></th>
					<th><?php echo lang('signup_column_created'); ?></th>
					<th><?php echo lang('signup_column_modified'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('signup_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/signup/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->first_name); ?></td>
				<?php else : ?>
					<td><?php e($record->first_name); ?></td>
				<?php endif; ?>
					<td><?php e($record->middle_name); ?></td>
					<td><?php e($record->last_name); ?></td>
					<td><?php e($record->email_id); ?></td>
					<td><?php e($record->password); ?></td>
					<td><?php e($record->mobile); ?></td>
					<td><?php e($record->address); ?></td>
					<td><?php e($record->city); ?></td>
					<td><?php e($record->post_code); ?></td>
					<td><?php e($record->country); ?></td>
					<td><?php e($record->dob); ?></td>
					<td><?php e($record->gender); ?></td>
					<td><?php e($record->mode); ?></td>
					<td><?php e($record->representation); ?></td>
					<td><?php e($record->team); ?></td>
					<td><?php e($record->categories); ?></td>
					<td><?php echo $record->deleted > 0 ? lang('signup_true') : lang('signup_false'); ?></td>
					<td><?php e($record->created_on); ?></td>
					<td><?php e($record->modified_on); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('signup_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>