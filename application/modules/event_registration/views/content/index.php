<?php

$num_columns	= 13;
$can_delete	= $this->auth->has_permission('Event_Registration.Content.Delete');
$can_edit		= $this->auth->has_permission('Event_Registration.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='row'>
    <span class="pull-left"><h4><?php echo lang('event_registration_area_title'); ?></h4></span>
    <span class="pull-right"><a class="btn btn-primary" href="<?php echo (base_url() . 'index.php/admin/content/event_registration/create'); ?>"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add Event</a></span>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('event_registration_field_category'); ?></th>
					<th><?php echo lang('event_registration_field_style'); ?></th>
					<th><?php echo lang('event_registration_field_performance'); ?></th>
					<th><?php echo lang('event_registration_field_team'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('event_registration_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/event_registration/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  
						$categories_select[$record->category]); ?></td>
				<?php else : ?>
					<td><?php e($categories_select[$record->category]); ?></td>
				<?php endif; ?>
					<td><?php e($style_select[$record->style]); ?></td>
					<td><?php e($performance_select[$record->performance]); ?></td>

					<td>
						<?php 
							$participants = unserialize($record->team);
							foreach($participants as $p){
								echo ($teams_select[$p]);
								echo ("<br/>");
							}
							//e($record->team); 
						?>
					</td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('event_registration_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>
