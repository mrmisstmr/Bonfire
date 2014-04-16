<?php
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

    <link rel="stylesheet" href="/assets/bootstrap3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="/assets/bootstrap3/css/bootstrap-theme.min.css" />
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

    <div class="navbar navbar-fixed-top navbar-inverse" id="topbar" role="navigation">

    </div>

    <div class="navbar navbar-static-top navbar-inverse" id="topbar" role="navigation">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn navbar-btn" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <?php
                echo anchor('/', html_escape($this->settings_lib->item('site.title')), 'class="brand"');
                if (isset($shortcut_data) && is_array($shortcut_data['shortcuts'])
                    && is_array($shortcut_data['shortcut_keys']) && count($shortcut_data['shortcut_keys'])
                   ) :
                ?>
                <!-- Shortcut Menu -->
                <div class="nav pull-right" id="shortcuts">
                    <div class="btn-group">
                        <a class="dropdown-toggle light btn" data-toggle="dropdown" href="#"><img src="<?php echo Template::theme_url('images/keyboard-icon.png'); ?>" id="shortkeys_show" title="Keyboard Shortcuts" alt="Keyboard Shortcuts" /></a>
                        <ul class="dropdown-menu pull-right toolbar-keys">
                            <li>
                                <div class="inner keys">
                                    <h4><?php echo lang('bf_keyboard_shortcuts'); ?></h4>
                                    <ul>
                                        <?php foreach ($shortcut_data['shortcut_keys'] as $key => $data) : ?>
                                        <li><span><?php e($data); ?></span> : <?php echo $shortcut_data['shortcuts'][$key]['description']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <a href="<?php echo site_url(SITE_AREA . '/settings/ui'); ?>"><?php echo lang('bf_keyboard_shortcuts_edit'); ?></a>
                                </div>
                            </li>
						</ul>
					</div>
                </div>
                <?php endif;?>
                <div class="navbar-collapse in collapse">
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
                    <?php echo Contexts::render_menu('text', 'normal'); ?>
                </div><!-- /.navbar-collapse -->
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