<?php
/**
 * Template Name: Investors Protected
 */
 if(!$lp_theme->is_logged_in_investor()) {
   wp_redirect("/wp-login.php");
 }
global $lp_theme;
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="main-content" class="hero-wrap">
    <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
    <div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
      <div class="col sm-col-6 line line-gold line-long pb3 pr4 mb3">
        <h1 id="text-intro"><?php the_field('page_heading') ?></h1>
        <?php if(get_field('page_subheading')) { ?>
        <h2 class="text-uppercase"><?php the_field('page_subheading') ?></h2>
        <?php } ?>
      </div>
      <div class="col sm-col-6 md-col-5 pb4 hero-secondary">
        <div class="pt2 line line-gold">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
  <section class="quote angle-right-small<?php if(get_field('page_background_overlay_color')) { ?> overlay overlay-<?php the_field('page_background_overlay_color') ?>"<?php } ?> style="background-image: url(<?php the_field('page_background_image') ?>);">
    <div class="wrapper">
      <div class="sm-col-12 flex flex-wrap">
        <?php
        while ( have_rows('blurbs') ) : the_row(); ?>
        <div class="sm-col-4 py2 px3 center">
          <?php $blurb_icon_arr = get_sub_field('blurb_icon'); ?>
          <span class="icon-circle block mx-auto">
            <img src="<?php echo $blurb_icon_arr['url'] ?>" />
          </span>
          <h3 class="text-uppercase"><?php the_sub_field('blurb_heading'); ?></h3>
          <?php the_sub_field('blurb_content'); ?>
        </div>
      <?php endwhile; ?>
      </div>
    </div>
  </section>

  <!-- BEGIN: Accordion Section Area -->
  <div class="angle-left-large py4">
    <div class="wrapper">
      <div class="clearfix mxn3">
        <div class="md-col md-col-6 px3 mb4">
          <h3 class="light-gold-text line line-gold"><?php the_field('resources_area_heading'); ?></h3>
          <?php the_field('resources_area_content'); ?>
          <?php
            if( have_rows('resources_cta_buttons') ):
              while ( have_rows('resources_cta_buttons') ) : the_row(); ?>
              <a href="<?php the_sub_field('button_link'); ?>" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn btn-gray max-width-1 mt2"><?php the_sub_field('button_text'); ?></a>
      <?php   endwhile;
            endif; ?>
        </div>
        <div class="md-col md-col-6 px3">
          <?php
            if( have_rows('accordion') ): ?>
          <ul class="list-reset">
            <?php while ( have_rows('accordion') ) : the_row(); ?>
            <li class="accordion-item pb2">
              <a href="javascript:;" class="accordion-title text-uppercase teal-text relative block pb1"><?php the_sub_field('item_title'); ?><img src="<?php $lp_theme->images_path() ?>/icon-plus-lightblue.svg" class="accordion-plus-minus"/></a>
              <ul class="accordion-content pt2 relative list-reset">
                <?php while ( have_rows('item_content') ) : the_row(); ?>
                <?php if(get_sub_field('document_file')) {
                  $document_file = get_sub_field('document_file');
                  $document_type = explode("/",$document_file['mime_type'])[1];
                  $investor_access = get_sub_field('investor_access');
                  ?>
                <?php if($lp_theme->is_in_investor_roles($investor_access)) { ?>
                <li class="<?php echo $document_type ?>-icon"><a href="<?php echo $document_file['url'] ?>" target="_blank"><img src="<?php $lp_theme->images_path() ?>/icon-pdf.svg" class="mr2"/><?php the_sub_field('document_title'); ?></a></li>
                <?php } ?>
                <?php } ?>
                <?php endwhile; ?>
              </ul>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
<!-- END: Accordion Section Area -->



  <!-- BEGIN: Prefooter -->
  <?php get_template_part('pre-footer') ?>
  <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
