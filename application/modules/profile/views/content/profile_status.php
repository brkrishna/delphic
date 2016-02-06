        <ul class="nav nav-wizard">
            <li role="presentation" class="active">
                <span class="badge">Amount Due:&nbsp;<span class="glyphicon glyphicon-usd"></span>&nbsp;&nbsp;<?php e(number_format($event_record_count * 11, 2)); ?></span>
            </li>
            <li role="presentation">
                <?php if (isset($profile_count) && $profile_count > 0) : ?>
                    <?php ($current_user_role_id == 7 ? $url = base_url() . 'index.php/admin/content/profile/edit/' . $this->session->userdata('profile_id') : $url = 'content/profile'); ?>
                    <a style="color:green;" href="<?php echo ($url); ?>"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Profile</a>
                <?php else : ?>
                    <?php ($current_user_role_id == 7 ? $url = base_url() . 'index.php/admin/content/profile/create' : $url = 'content/profile'); ?>
                    <a style="color:orange;" href="<?php echo ($url); ?>"><span class="glyphicon glyphicon-th-large"></span>&nbsp;Profile</a>
                <?php endif; ?>
            </li>
            <li role="presentation">
                <?php if (isset($team_count) && $team_count > 0) : ?>
                    <a style="color:green;" href="<?php e(base_url() . 'index.php/admin/content/team'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Team</a>
                <?php else : ?>
                    <a style="color:orange;" href="<?php e(base_url() . 'index.php/admin/content/team'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Team</a>
                <?php endif; ?>
            </li>
            <li role="presentation">
                <?php if (isset($event_count) && $event_count > 0) : ?>
                    <a style="color:green;" href="<?php e(base_url() . 'index.php/admin/content/registration'); ?>"><span class="glyphicon glyphicon-list"></span>&nbsp;Events</a
                <?php else : ?>
                    <a style="color:orange;" href="<?php e(base_url() . 'index.php/admin/content/registration'); ?>"><span class="glyphicon glyphicon-list"></span>&nbsp;Events</a
                <?php endif; ?>
            </li>
            <li role="presentation">
                <?php if (isset($payments) && $payments > 0) : ?>
                    <a style="color:green;" href="<?php e(base_url() . 'index.php/admin/content/registration/summary'); ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;Payments</a
                <?php else : ?>
                    <a style="color:orange;" href="<?php e(base_url() . 'index.php/admin/content/registration/summary'); ?>"><span class="glyphicon glyphicon-credit-card"></span>&nbsp;Payments</a
                <?php endif; ?>
            </li>
        </ul>
