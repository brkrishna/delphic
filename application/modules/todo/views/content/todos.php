<br/>
<?php if (validation_errors()) : ?>
<div class="notification error">
  <?php echo auth_errors() . validation_errors(); ?>
</div>
<?php endif; ?>

<?php echo form_open(current_url(), 'style="max-width: 700px"') ?>

  <input type="text" name="notes" placeholder="What Do You Need To Do?" value="" />

  <div class="submits">
      <input type="submit" name="submit" value="Create New Item" />
  </div>

<?php echo form_close(); ?>

<?php if (isset($items) && is_array($items) && count($items)) : ?>
<h3>ToDo Items</h3>

<?php echo form_open(current_url() .'/delete', 'class="ajax-form todo-form"'); ?>
<table>
  <tbody>
  <?php foreach ($records as $record) : ?>
      <tr>
          <td style="width: 1em; text-align: center">
              <input type="checkbox" name="items[]" value="1" data-id="<?php echo($record->id); ?>" />
          </td>
          <td><?php echo($record->notes); ?></td>
      </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php echo form_close(); ?>

<?php endif; ?>