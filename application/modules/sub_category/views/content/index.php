<?php

$num_columns	= 8;
$can_delete	= $this->auth->has_permission('Sub_Category.Content.Delete');
$can_edit		= $this->auth->has_permission('Sub_Category.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('sub_category_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('sub_category_field_category'); ?></th>
					<th><?php echo lang('sub_category_field_code'); ?></th>
					<th><?php echo lang('sub_category_field_desc'); ?></th>
					<th><?php echo lang('sub_category_field_comments'); ?></th>
					<th><?php echo lang('sub_category_field_sort_order'); ?></th>
					<th><?php echo lang('sub_category_column_deleted'); ?></th>
					<th><?php echo lang('sub_category_column_created'); ?></th>
					<th><?php echo lang('sub_category_column_modified'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('sub_category_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/sub_category/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->category); ?></td>
				<?php else : ?>
					<td><?php e($record->category); ?></td>
				<?php endif; ?>
					<td><?php e($record->code); ?></td>
					<td><?php e($record->desc); ?></td>
					<td><?php e($record->comments); ?></td>
					<td><?php e($record->sort_order); ?></td>
					<td><?php echo $record->deleted > 0 ? lang('sub_category_true') : lang('sub_category_false'); ?></td>
					<td><?php e($record->created_on); ?></td>
					<td><?php e($record->modified_on); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('sub_category_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>