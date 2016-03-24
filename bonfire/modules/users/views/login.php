<?php
	$site_open = $this->settings_lib->item('auth.allow_register');
?>
<!--<p><br/><a href="<?php echo site_url(); ?>">&larr; <?php echo lang('us_back_to') . $this->settings_lib->item('site.title'); ?></a></p>-->

<div id="login" style="border-radius: 0px; max-width: 435px;">
	<p>
		<!--<?php if ( $site_open ) : ?>
			<?php echo anchor(REGISTER_URL, lang('us_sign_up')); ?>
		<?php endif; ?>-->
		Don't have an account , <strong><a class="text-sty" href="<?php e(REGISTER_URL, lang('us_register')); ?>">Sign Up</a></strong>
		<br/>
	</p>
	<h2><?php echo lang('us_login'); ?></h2>

	<?php echo Template::message(); ?>

	<?php
		if (validation_errors()) :
	?>
	<div class="row-fluid">
		<div class="span12">
			<div class="alert alert-error fade in">
			  <a data-dismiss="alert" class="close">&times;</a>
				<?php echo validation_errors(); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php echo form_open(LOGIN_URL, array('autocomplete' => 'off', 'class'=>'form-signin')); ?>
		<div class="control-group <?php echo iif( form_error('login') , 'error') ;?>">
			<div class="controls">
				<input style="margin: 20px 0 16px;" class="form-control" type="email" required autofocus name="login" id="login_value" value="<?php echo set_value('login'); ?>" tabindex="1" placeholder="Email" />
			</div>
		</div>
        
		<div class="control-group <?php echo iif( form_error('password') , 'error') ;?>">
			<div class="controls">
				<input class="form-control" type="password" name="password" id="password" value="" tabindex="2" placeholder="<?php echo lang('bf_password'); ?>" />
			</div>
		</div>


		<?php if ($this->settings_lib->item('auth.allow_remember')) : ?>
			<div class="control-group">
				<div class="checkbox" style="margin: 13px 0 -3px;">
					<label class="checkbox" for="remember_me">
						<input class="checkbox" type="checkbox" name="remember_me" id="remember_me" value="1" tabindex="3" />
						<span class="inline-help"><?php echo lang('us_remember_note'); ?></span>
					</label>
				</div>
			</div>
		<?php endif; ?>
        <br/>
		<div class="control-group">
			<div class="controls">
				<input style="padding: 8px 24px;" class="btn btn-large btn-primary" type="submit" name="log-me-in" id="submit" value="<?php e(lang('us_let_me_in')); ?>" tabindex="5" />&nbsp;
				<?php if ( $site_open ) : ?>
					<a style="padding: 8px 24px; margin-left:10px;" class="btn btn-large btn-primary" href="<?php e(REGISTER_URL, lang('us_register')); ?>"><?php echo(lang('us_register')); ?></a>
				<?php endif; ?>
			</div>
		</div>
	<?php echo form_close(); ?>
    <br/>
	<?php // show for Email Activation (1) only
		if ($this->settings_lib->item('auth.user_activation_method') == 1) : ?>
	    <!-- Activation Block -->
			<p style="text-align: left" class="well">
				<?php echo lang('bf_login_activate_title'); ?><br />
				<?php
				$activate_str = str_replace('[ACCOUNT_ACTIVATE_URL]',anchor('/activate', lang('bf_activate')),lang('bf_login_activate_email'));
				$activate_str = str_replace('[ACTIVATE_RESEND_URL]',anchor('/resend_activation', lang('bf_activate_resend')),$activate_str);
				echo $activate_str; ?>
			</p>
	<?php endif; ?>

	<p style="text-align:center;">
		<?php echo anchor('/forgot_password', lang('us_forgot_your_password')); ?>
	</p>

</div>