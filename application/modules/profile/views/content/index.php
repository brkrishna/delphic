<?php

$num_columns	= 17;
$can_delete	= $this->auth->has_permission('Profile.Content.Delete');
$can_edit		= $this->auth->has_permission('Profile.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('profile_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('profile_field_entity_type'); ?></th>
					<th><?php echo lang('profile_field_entity_name'); ?></th>
					<th><?php echo lang('profile_field_contact_name'); ?></th>
					<th><?php echo lang('profile_field_address'); ?></th>
					<th><?php echo lang('profile_field_city'); ?></th>
					<th><?php echo lang('profile_field_country'); ?></th>
					<th><?php echo lang('profile_field_post_code'); ?></th>
					<th><?php echo lang('profile_field_contact_number'); ?></th>
					<th><?php echo lang('profile_field_email_id'); ?></th>
					<th><?php echo lang('profile_field_regn_nbr'); ?></th>
					<!--<th><?php echo lang('profile_field_profile'); ?></th>
					<th><?php echo lang('profile_field_addl_info'); ?></th>-->
					<!--<th><?php echo lang('profile_field_image'); ?></th>-->
					<!--<th><?php echo lang('profile_column_deleted'); ?></th>
					<th><?php echo lang('profile_column_created'); ?></th>
					<th><?php echo lang('profile_column_modified'); ?></th>-->
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('profile_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/profile/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->entity_type); ?></td>
				<?php else : ?>
					<td><?php e($record->entity_type); ?></td>
				<?php endif; ?>
					<td><?php e($record->entity_name); ?></td>
					<td><?php e($record->contact_name); ?></td>
					<td><?php e($record->address); ?></td>
					<td><?php e($record->city); ?></td>
					<td><?php e($countries_select[$record->country]); ?></td>
					<td><?php e($record->post_code); ?></td>
					<td><?php e($record->contact_number); ?></td>
					<td><?php e($record->email_id); ?></td>
					<td><?php e($record->regn_nbr); ?></td>
					<!--<td><?php e($record->profile); ?></td>
					<td><?php e($record->addl_info); ?></td>-->
					<!--<td><?php echo(isset($record->image) ? anchor(base_url() . 'uploads/' . unserialize($record->image)['file_name'], unserialize($record->image)['file_name']) : ''); ?></td>-->
					<!--<td><?php echo $record->deleted > 0 ? lang('profile_true') : lang('profile_false'); ?></td>
					<td><?php e($record->created_on); ?></td>
					<td><?php e($record->modified_on); ?></td>-->
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('profile_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>