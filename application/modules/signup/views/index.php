<?php

$hiddenFields = array('id', 'deleted', 'deleted_by', 'created_by', 'modified_by',);
?>
<h1 class='page-header'>
    <?php echo lang('signup_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Email ID</th>
            <th>Password</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>City</th>
            <th>Zip or Postal Code</th>
            <th>Country</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Mode</th>
            <th>Representation</th>
            <th>Team</th>
            <th>Categories</th>
            <th><?php echo lang('signup_column_created'); ?></th>
            <th><?php echo lang('signup_column_modified'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($records as $record) :
        ?>
        <tr>
            <?php
            foreach($record as $field => $value) :
                if ( ! in_array($field, $hiddenFields)) :
            ?>
            <td>
                <?php
                if ($field == 'deleted') {
                    e(($value > 0) ? lang('signup_true') : lang('signup_false'));
                } else {
                    e($value);
                }
                ?>
            </td>
            <?php
                endif;
            endforeach;
            ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php

    echo $this->pagination->create_links();
endif; ?>