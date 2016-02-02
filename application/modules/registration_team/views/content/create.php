<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('registration_team_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($registration_team->id) ? $registration_team->id : '';

?>
<div class="row-fluid">
    <ul class="nav nav-pills">
        <?php echo Modules::run('profile/profile_status'); ?>
    </ul>
</div>
<div class="row-fluid">
    <h4>Registration Team</h4><br/>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            <div class="control-group<?php echo form_error('registration') ? ' error' : ''; ?>">
                <div class='controls'>
                    <input id='registration' type='hidden' name='registration' value="<?php echo set_value('registration', isset($registration_team->registration) ? $registration_team->registration : $registration_nbr ); ?>" />
                    <span class='help-inline'><?php echo form_error('registration'); ?></span>
                </div>
            </div>
            <div class="control-group">
                <?php foreach($registration as $row) { ?>
                    <div class="controls"><span class="alert alert-success">You are adding team member for Category -> <?php e($row->category . ' -> ' . $row->style . ' -> ' . $row->performance); ?> Performance 
                <?php } ?>
            </div>
            <br/>
			<?php 
                if (is_array($teams_select) && count($teams_select)) :
				    echo form_dropdown(array('id'=>'team', 'name'=>'team'), $teams_select, set_value('team', isset($registration['team']) ? $registration['team'] : ''), 'Team'. lang('bf_form_label_required'), "tabindex='1'");
                endif;
			?>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('registration_team_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($registration_team->comments) ? $registration_team->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>
        </fieldset>
        <br/>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('registration_team_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/registration_team/create/' . $registration_nbr, lang('registration_team_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
    <br/>
    <?php
    
    $num_columns	= 7;
    $can_delete	= $this->auth->has_permission('Registration_Team.Content.Delete');
    $can_edit		= $this->auth->has_permission('Registration_Team.Content.Edit');
    $has_records	= isset($records) && is_array($records) && count($records);
    
    if ($can_delete) {
        $num_columns++;
    }
    ?>    
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped table-condensed'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					<th><?php echo lang('registration_team_field_team'); ?></th>
					<th><?php echo lang('registration_team_field_comments'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('registration_team_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/registration_team/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->name); ?></td>
				<?php else : ?>
					<td><?php e($record->name); ?></td>
				<?php endif; ?>
					<td><?php e($record->comments); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('registration_team_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    ?>    
</div>