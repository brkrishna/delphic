<div class="row">
    <ul class="nav nav-tabs pull-right">
        <li <?php echo check_class('home'); ?>><a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php e(lang('bf_home')); ?></a></li>
        <?php if (empty($current_user)) : ?>
        <li><a href="<?php echo site_url(LOGIN_URL); ?>"><span class="glyphicon glyphicon-log-in"></span>&nbsp;Sign In</a></li>
        <?php else : ?>
        <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('users/profile'); ?>"><span class="glyphicon glyphicon-cog"></span>&nbsp;<?php e(lang('bf_user_settings')); ?></a></li>
        <li><a href="<?php echo site_url('logout'); ?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<?php e(lang('bf_action_logout')); ?></a></li>
        <?php endif; ?>
    </ul>
    <h3 class="muted">
        <img src="<?php e(base_url() . "themes/default/images/delphic_logo.png"); ?>" />
    </h3>
</div>
<hr />