<?php
/**
 * Page Name: Template for displaying all pages
 *
 */
global $lp_theme;
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div class="conference-page hero-wrap">
    <div id="main-content" class="hero-wrap">
      <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
      <div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
        <div class="col sm-col-6 line line-gold line-long pr4">
          <h1 id="text-intro"><?php the_field('page_heading') ?></h1>
          <div class="header-left">
            <p><strong>WHEN:</strong></p>
            <p><strong>WHERE:</strong></p>
          </div>
          <div class="header-right">
            <?php if(get_field('when')) { ?>
              <p class=""><?php the_field('when') ?></p>
            <?php } ?>
            <?php if(get_field('when')) { ?>
              <p class=""><?php the_field('where') ?></p>
            <?php } ?>
          </div>
          <?php if(get_field('conference_description')) { ?>
            <?php the_field('conference_description') ?>
          <?php } ?>
        </div>
        <div class="col sm-col-6 md-col-5">
          <div class="line line-gold page-heading-sidebar pt2">
            <strong>
              <?php if(get_field('page_heading_sidebar')) { ?>
                <?php the_field('page_heading_sidebar') ?>
              <?php } ?>
            </strong>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-fixed">
      <div class="bg-fixed-inner" style="background-image: url(<?php the_field('background_image') ?>);"></div>
    </div>

    <div class="angle-left-large">
      <div class="wrapper">
        <div class="clearfix mxn3">
          <div class="md-col md-col-8 px3">
            <h3 class="light-gold-text line line-gold"><?php the_field('section_2_header'); ?></h3>
            <p><?php the_field('section_2_description'); ?></p>
            <p><strong><?php the_field('section_2_pre-button'); ?></strong></p>
            <a href="<?php the_field('section_2_button_link'); ?>" role="button" class="text-uppercase btn btn-blue-on-light mr2 text-elem"><?php the_field('section_2_button_text'); ?></a>
            <p><strong><?php the_field('section_2_post-button'); ?></strong></p>
          </div>
        </div>
      </div>
    </div>

    <?php get_template_part('pre-footer') ?>

  </div>

<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
