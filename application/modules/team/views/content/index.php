<?php

$num_columns	= 16;
$can_delete	= $this->auth->has_permission('Team.Content.Delete');
$can_edit		= $this->auth->has_permission('Team.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class="row">
	<hr/>
    <span class="pull-left"><h4><?php echo lang('team_area_title'); ?></h4></span>
    <span class="pull-right"><a class="btn btn-primary" href="<?php echo (base_url() . 'index.php/admin/content/team/create'); ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Member</a></span>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					<th><?php echo lang('team_field_name'); ?></th>
					<th><?php echo lang('team_field_gender'); ?></th>
					<th><?php echo lang('team_field_dob'); ?></th>
					<!--<th><?php echo lang('team_field_contact_nbr'); ?></th>-->
					<th><?php echo lang('team_field_email'); ?></th>
					<!--<th><?php echo lang('team_field_profession'); ?></th>-->
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('team_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/team/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->name); ?></td>
				<?php else : ?>
					<td><?php e($record->name); ?></td>
				<?php endif; ?>
					<td><?php e($record->gender); ?></td>
					<td><?php e($record->dob); ?></td>
					<!--<td><?php e($record->contact_nbr); ?></td>-->
					<td><?php e($record->email); ?></td>
					<!--<td><?php e($record->profession); ?></td>-->
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('team_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
    <div class="well well-lg">
        <p class="text-justify">
            <h2>What is this Team?</h2>
            <hr/>
            If you are a group of performers, you will create entries for each team member here. Once added, you can map these team members as participants for various events
        </p>
    </div>
</div>