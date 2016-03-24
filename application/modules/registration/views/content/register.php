<?php
$can_delete	= $this->auth->has_permission('Registration_Team.Content.Delete');
$can_edit		= $this->auth->has_permission('Registration_Team.Content.Edit');
$has_profile_team	= isset($profile_team) && is_array($profile_team) && count($profile_team);

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
	<a class='close' data-dismiss='alert'>&times;</a>
	<h4 class='alert-heading'>
		<?php echo lang('registration_errors_message'); ?>
	</h4>
	<?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($registration->id) ? $registration->id : '';

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  
	  $("#category").change(function(){
	  
		 $("#style > option").remove();
		 $("#performance > option").remove();
		 
		 var opt = $('<option />');
		 opt.val('-1');
		 opt.text('Select one');
		 
		 $("#style").append(opt);
		 $("#performance").append(opt);
			 
		 var catg = $("#category").val();
		 $.ajax({
			type: "POST",
			url: "get_category_styles/" + catg,
			success: function(styles){
				$.each(styles, function(id, desc){
					var opt = $('<option />');
					  opt.val(id);
					  opt.text(desc);
					  $("#style").prepend(opt);
				});
				$("#style").val("-1");
			}
		 });
		 
	  });
	  $("#style").change(function(){
	  
		 $("#performance > option").remove();
		 
		 var style = $("#style").val();
		 $.ajax({
			type: "POST",
			url: "get_style_performances/" + style,
			success: function(performances){
				$.each(performances, function(id, desc){
					var opt = $('<option />');
					  opt.val(id);
					  opt.text(desc);
					  $("#performance").prepend(opt);
				});
				$("#performance").val("-1");
			}
		 });
		 
	  });
	  
  });
</script>
<div class="row">
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
    <hr/>
    <h4>Registration</h4>
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="form-group">
			<?php 
                if (is_array($categories_select) && count($categories_select)) :
				    echo form_dropdown(array('class'=>'form-control', 'id'=>'category', 'name'=>'category'), $categories_select, set_value('category', isset($registration->category) ? $registration->category : ''), 'Category'. lang('bf_form_label_required'), "tabindex='1'");
                endif;
			?>
        </div>
        <div class="form-group">
            <?php // Change the values in this array to populate your dropdown as required
                $options = array('-1'=>'Select one',
                );
                echo form_dropdown(array('class'=>'form-control', 'id' => 'style', 'name'=>'style'), $options, set_value('style', isset($registration->style) ? $registration->style : ''), lang('registration_field_style') . lang('bf_form_label_required'));
            ?>
        </div>
        <div class="form-group">
            <?php // Change the values in this array to populate your dropdown as required
                $options = array('-1'=>'Select one',
                );
                echo form_dropdown(array('class'=>'form-control', 'id' => 'performance', 'name'=>'performance', 'required' => 'required'), $options, set_value('performance', isset($registration->performance) ? $registration->performance : ''), lang('registration_field_performance') . lang('bf_form_label_required'));
            ?>
        </div>
        <div class="form-group<?php echo form_error('comments') ? ' error' : ''; ?>">
            <?php echo form_label(lang('registration_field_comments'), 'comments', array('class' => 'control-label')); ?>
            <?php echo form_textarea(array('class'=>'form-control', 'name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($registration->comments) ? $registration->comments : ''))); ?>
            <span class='help-inline'><?php echo form_error('comments'); ?></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-10 col-md-4">
        <div class="well well-lg">
            <p class="text-justify">
                <h2>What is this Registration?</h2>
	            <hr/>
	            To enroll for an event and indicate your participants (team members) and showcase your artifacts (as document attachments) to 
	            substantiate your application 
	            <br/><br/>
	            Steps involved
	            <ul>    
	                <li>Click on Add Event</li>
	                <li>Choose the Art Category, Style and Performance, add any additional information</li>
	                <li>Add Team members against the registation</li>
	                <li>Attach documents with title and notes to substantiate your application</li>
	            </ul>
            </p>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-8 form-group">
        <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('registration_action_create'); ?>" />
        <?php echo lang('bf_or'); ?>
        <input type='submit' name='saveanother' class='btn btn-primary' value="<?php echo lang('registration_action_create_another'); ?>" />
        <?php echo lang('bf_or'); ?>
        <?php echo anchor(SITE_AREA . '/content/registration', lang('registration_cancel'), 'class="btn btn-warning"'); ?>
    </div>

    <div class="col-xs-12 col-sm-6 col-md-8 form-group">
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
			<?php if ($has_profile_team) : ?>
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
				if ($has_profile_team) :
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
    </div>
</div>
<?php echo form_close(); ?>
