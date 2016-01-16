<?php

$hiddenFields = array('id', 'deleted', 'deleted_by', 'created_by', 'modified_by',);
?>
<h1 class='page-header'>
    <?php echo lang('profile_area_title'); ?>
</h1>
<?php if (isset($records) && is_array($records) && count($records)) : ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            
            <th>Type</th>
            <th>Name</th>
            <th>Contact Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Country</th>
            <th>Postal Code</th>
            <th>Contact Number</th>
            <th>Email ID</th>
            <th>Registration Number</th>
            <th>Profile</th>
            <th>Additional Info</th>
            <th>Image</th>
            <th><?php echo lang('profile_column_created'); ?></th>
            <th><?php echo lang('profile_column_modified'); ?></th>
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
                    e(($value > 0) ? lang('profile_true') : lang('profile_false'));
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