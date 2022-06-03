<?php
/**
 * Header template
 **/
global $lp_theme;
global $post;
$current_post_id = -1;
if ($post) {
    $current_post_id = $post->ID;
}
?><!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<title><?php wp_title( '|', true, 'left' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="google-site-verification" content="RovgVxQ-cIvi6c9La8Y1R7oDpN-QL_4tzmvMPakfjdg" />
	<meta name="msvalidate.01" content="39788A9F65A0BB898974D4BC204A70B5" />
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MR9GQ6G');</script>
  <!-- End Google Tag Manager -->
  <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR9GQ6G"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
  <div class="animsition">
  <a class="page-skipLink" href="#main-content" title="Skip to content">Skip to content</a>
  <div class="navbar navbar-fixed-top navbar-inverse" id="nav">
    <!--
    <div class="pop-down">
      <a href="/conference"><p>Visit our booth #2829 at NAPE Summit in Houston!</p></a>
    </div>
    -->
    <span class="shaded"></span>
    <div class="wrapper">
      <div class="row">
        <div class="navbar-header">
          <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
          </button>
          <div class="logo-wrap logo-mobile mobile-show">
            <a href="/" class="animsition-link">
              <h1 class="sr-only">LongPoint Logo</h1>

              <!-- this is the mobile logo -->
              <img src="<?php $lp_theme->images_path(); ?>/logo-stack-white.svg" alt="LongPoint Logo" class="icon-logo">
            </a>
          </div>
        </div>
        <div class="navbar-inverse side-collapse in">
          <nav class="navbar-collapse nav-wrap">
            <div class="navbar-header">
              <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle nav-close pull-left">
                <img src="<?php $lp_theme->images_path(); ?>/icon_x_blue.svg" class="menu-close-icon" alt="menu close icon">
              </button>
              <div class="logo-wrap logo-mobile mobile-show">
                <a href="/" class="animsition-link">
                  <h1>LongPoint Logo</h1>
                  <img src="<?php $lp_theme->images_path(); ?>/logo-stack.svg" alt="LongPoint Logo" class="icon-logo">
                </a>
              </div>
            </div>

            <div class="logo-wrap hidden-mobile">
              <a href="/" class="animsition-link">
                <h1 class="sr-only">LongPoint Logo</h1>
                <img src="<?php $lp_theme->images_path(); ?>/logo-stack-white.svg" alt="LongPoint Logo" class="icon-logo">
              </a>
            </div>
            <div class="item-wrap">
              <div class="hidden-mobile upper-nav-container-desktop">
                <ul class="upper-nav">
  								<?php
  								$secondary_navitems = wp_get_nav_menu_items('upper-menu');
  								foreach($secondary_navitems as $navitem) { ?>
  									<li class="<?php if($current_post_id == $navitem->object_id) echo('nav-active') ?>"><a class="animsition-link" href="<?php echo $navitem->url ?>"<?php if($navitem->target != '') echo(' target="'.$navitem->target.'"') ?>><?php echo $navitem->title ?></a></li>
  								<?php } ?>
                  <?php if($lp_theme->is_logged_in_investor()) { ?>
                    <li class="investor-nav">Welcome, <?php $lp_theme->the_user_display_name(); ?> | <a href="<?php echo wp_logout_url( '/' ); ?>">Logout</a></li>
                  <?php } ?>
                </ul>
              </div>
              <ul class="nav navbar-nav">
                <?php
                $primary_navitems = wp_get_nav_menu_items('main-menu');
                foreach($primary_navitems as $navitem) { ?>
                  <li class="<?php if($current_post_id == $navitem->object_id) echo('nav-active') ?>"><a href="<?php echo $navitem->url ?>"<?php if($navitem->target != '') echo(' target="'.$navitem->target.'"') ?> class="nav-link animsition-link text-uppercase"><?php echo $navitem->title ?></a></li>
                <?php } ?>
                <li class="mobile-show no-hover">
                  <ul class="upper-nav upper-nav-container-mobile">
                    <?php foreach($secondary_navitems as $navitem) { ?>
    									<li><a href="<?php echo $navitem->url ?>"<?php if($navitem->target != '') echo(' target="'.$navitem->target.'"') ?> class="animsition-link"><?php echo $navitem->title ?></a></li>
    								<?php } ?>
                    <?php if($lp_theme->is_logged_in_investor()) { ?>
                      <li class="investor-nav">Welcome, <?php $lp_theme->the_user_display_name(); ?> | <a href="<?php echo wp_logout_url( '/' ); ?>">Logout</a></li>
                    <?php } ?>
                  </ul>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- BEGIN: page-content -->
