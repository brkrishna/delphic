<div class="row">
	<div class="col-md-4">
	    <h3 class="muted">
	        <img src="<?php e(base_url() . "themes/default/images/delphic_logo.png"); ?>" />
	    </h3>
	</div>
	<div class="col-md-8">
	    <?php if(!empty($current_user)) : ?>
	    <ul class="nav nav-pills pull-right">
	    	<li <?php echo check_class('home'); ?>>
	    		<a href="<?php echo site_url(); ?>"><span class="glyphicon glyphicon-home"></span>&nbsp;<?php e(lang('bf_home')); ?></a>
	    	</li>
	        <li>
	        	<a href="<?php echo site_url('logout'); ?>"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<?php e(lang('bf_action_logout')); ?></a>
	        </li>
	    </ul>
	    <?php endif; ?>
	</div>
	<div class="col-md-8">
		<hr/>
	    <ul class="nav nav-pills pull-right">
	        <?php echo Modules::run('profile/profile_status'); ?>
	    </ul>
	</div>
</div>
