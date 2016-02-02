<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-error fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('category_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($category->id) ? $category->id : '';

?>
<div class='admin-box'>
    <h3>Category</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="ajax-form form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('code') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_code'), 'code', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='code' type='text' name='code' maxlength='255' value="<?php echo set_value('code', isset($category->code) ? $category->code : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('code'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('desc') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_desc') . lang('bf_form_label_required'), 'desc', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='desc' type='text' required='required' name='desc' maxlength='255' value="<?php echo set_value('desc', isset($category->desc) ? $category->desc : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('desc'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('comments') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_comments'), 'comments', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'cols' => '80', 'value' => set_value('comments', isset($category->comments) ? $category->comments : ''))); ?>
                    <span class='help-inline'><?php echo form_error('comments'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('sort_order') ? ' error' : ''; ?>">
                <?php echo form_label(lang('category_field_sort_order') . lang('bf_form_label_required'), 'sort_order', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='sort_order' type='text' required='required' name='sort_order' maxlength='5' value="<?php echo set_value('sort_order', isset($category->sort_order) ? $category->sort_order : ''); ?>" />
                    <span class='help-inline'><?php echo form_error('sort_order'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('category_action_create'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/content/category', lang('category_cancel'), 'class="btn btn-warning"'); ?>
            
        </fieldset>
    <?php echo form_close(); ?>
</div>
<?php

$num_columns	= 7;
$can_delete	= $this->auth->has_permission('Category.Content.Delete');
$can_edit		= $this->auth->has_permission('Category.Content.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('category_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('category_field_code'); ?></th>
					<th><?php echo lang('category_field_desc'); ?></th>
					<th><?php echo lang('category_field_comments'); ?></th>
					<th><?php echo lang('category_field_sort_order'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('category_delete_confirm'))); ?>')" />
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
					<td><?php echo anchor(SITE_AREA . '/content/category/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->code); ?></td>
				<?php else : ?>
					<td><?php e($record->code); ?></td>
				<?php endif; ?>
					<td><?php e($record->desc); ?></td>
					<td><?php e($record->comments); ?></td>
					<td><?php e($record->sort_order); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('category_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>