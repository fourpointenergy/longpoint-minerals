<?php
/**
 * Template for displaying 404 Page (Page not found)
 */
global $lp_theme;
get_header(); ?>
  <div id="main-content" class="container general-content" style="margin-bottom: 9rem;">
    <div class="hero-wrap home-hero">
      <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
      <div class="hero-inner px2" id="js-hero-height">
        <div class="md-col-6 inline-block line line-gold line-long">
          <h1 class="text-uppercase h1-home" id="text-intro">Page Not Found</h1>
          <h3 class="text-uppercase h5-blue-caps md-hide lg-hide text-elem">Apologies, but the page you requested could not be found.</h3>
            <a href="/" role="button" class="text-uppercase btn btn-white btn-white-on-dark mr2 text-elem">Back to the home page</a>
            </div>
        <div class="md-col-6 right px2 xs-hide sm-hide hero-secondary">
          <h3 class="text-uppercase h5-blue-caps px4 line line-gold">Apologies, but the page you requested could not be found.</h3>
        </div>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
