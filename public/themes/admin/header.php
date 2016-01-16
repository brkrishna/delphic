<?php

Assets::add_css(array(
    'bootstrap.css',
    'bootstrap-responsive.css',
    'custom.css',
));

if (isset($shortcut_data) && is_array($shortcut_data['shortcut_keys'])) {
    Assets::add_js($this->load->view('ui/shortcut_keys', $shortcut_data, true), 'inline');
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php
        echo isset($toolbar_title) ? "{$toolbar_title} : " : '';
        e($this->settings_lib->item('site.title'));
    ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex" />
    <?php
    /* Modernizr is loaded before CSS so CSS can utilize its features */
    ?>
	<script src="<?php echo Template::theme_url('js/modernizr-2.5.3.js'); ?>"></script>
	<?php echo Assets::css(null, true); ?>
</head>
<body class="desktop">
    <!--[if lt IE 7]>
    <p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or
    <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p>
    <![endif]-->
	<noscript>
		<p>Javascript is required to use Bonfire's admin.</p>
	</noscript>
    <div class="navbar navbar-static-top " id="topbar" >


    <div class="logo-main-cnt"><a href="http://youthdelphicgames.com/"><img src="<?php echo(base_url() . 'assets/images/delphic_logo2.png'); ?>"/></a>

    </div>


        <div class="navbar-bg">
            <div class="container-fluid">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="nav-collapse in collapse">
                <div style="position: absolute;top: 28px;"><a href="http://youthdelphicgames.com/"><img src="<?php echo(base_url() . 'assets/images/home.png'); ?>"/></a></div>
                    <!-- User Menu -->
                    <div class="nav pull-right" id="user-menu">
                        <div class="btn-group">
                            <a href="<?php echo site_url(SITE_AREA . '/settings/users/edit'); ?>" id="tb_email" class="btn dark" title="<?php echo lang('bf_user_settings'); ?>">
                                <?php
                                $userDisplayName = isset($current_user->display_name) && ! empty($current_user->display_name) ? $current_user->display_name : ($this->settings_lib->item('auth.use_usernames') ? $current_user->username : $current_user->email);
                                echo $userDisplayName;
                                ?>
                            </a>
                            <?php
                            /* Change **light** to **dark** to match colors */
                            ?>
                            <a class="btn dropdown-toggle light" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                            <ul class="dropdown-menu pull-right toolbar-profile">
                                <li>
                                    <div class="inner">
                                        <div class="toolbar-profile-img">
                                            <?php echo gravatar_link($current_user->email, 96, null, $userDisplayName); ?>
                                        </div>

                                        <div class="toolbar-profile-info">
                                            <p><strong><?php echo $userDisplayName; ?></strong><br />
                                                <?php e($current_user->email); ?>
                                                <br/>
                                            </p>
                                            <a href="<?php echo site_url(SITE_AREA . '/settings/users/edit'); ?>"><?php echo lang('bf_user_settings'); ?></a>
                                            <a href="<?php echo site_url('logout'); ?>"><?php echo lang('bf_action_logout'); ?></a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!-- /.nav-collapse -->
			</div><!-- /container -->
			<div class="clearfix"></div>
		</div><!-- /.navbar-inner -->
	</div><!-- /.navbar -->
    <div class="subnav" >
       <div class="container-fluid">
           <?php if (isset($toolbar_title)) : ?>
            <h1><?php echo $toolbar_title; ?></h1>
           <?php endif; ?>
           <div class="pull-right" id="sub-menu">
               <?php Template::block('sub_nav', ''); ?>
           </div>
       </div>
   </div>
