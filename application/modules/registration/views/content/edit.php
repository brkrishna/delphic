<?php

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
    <hr/>
    <h4>Create Registration</h4>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <div class="col-xs-12 col-sm-6 col-md-8">
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
            <div class="form-group">
                <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('registration_action_create'); ?>" />
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(base_url() . 'index.php/admin/content/registration_team/create/' . $registration->id, lang('registration_action_add_team'), array('class'=>'btn btn-primary',)); ?> 
                <?php echo lang('bf_or'); ?>
                <?php echo anchor(SITE_AREA . '/content/registration', lang('registration_cancel'), 'class="btn btn-warning"'); ?>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>