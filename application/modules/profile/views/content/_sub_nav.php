<?php

$checkSegment = $this->uri->segment(4);
$areaUrl = SITE_AREA . '/content/profile';

?>
        <ul class="nav nav-pills">
          <li role="presentation" class="active"><a href="<?php echo site_url(); ?>">Overview</a></li>
            <?php 
                if(isset($current_user)) {
                    $current_user->role_id == 7 ? $url = 'index.php/admin/content/profile/edit/' . $this->session->userdata('profile_id') : $url = 'index.php/admin/content/profile';
                }else{
                    $url = base_url() . 'index.php/admin/content/profile/create';
                }
            ?>
          <li role="presentation"><a href="<?php echo($url); ?>">Profile</a></li>
          <li role="presentation"><a href="#">Team</a></li>
          <li role="presentation"><a href="#">Events</a></li>
          <li role="presentation"><a href="#">Payments</a></li>
        </ul>    
<!--
<ul class='nav nav-pills'>

	<li<?php echo $checkSegment == '' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl); ?>" id='list'>
            <?php echo lang('profile_list'); ?>
        </a>
	</li>
	<?php if ($this->auth->has_permission('Profile.Content.Create')) : ?>
	<li<?php echo $checkSegment == 'create' ? ' class="active"' : ''; ?>>
		<a href="<?php echo site_url($areaUrl . '/create'); ?>" id='create_new'>
            <?php echo lang('profile_new'); ?>
        </a>
	</li>
	<?php endif; ?>
</ul>-->