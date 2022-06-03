<?php
/**
 * Page Name: Community
 *
 */
global $lp_theme;
get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div class="hero-wrap">
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
          <?php
            if( have_rows('cta_buttons') ):
              while ( have_rows('cta_buttons') ) : the_row(); ?>
              <a href="<?php the_sub_field('button_link'); ?>" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn btn-white btn-white-on-dark mr2"><?php the_sub_field('button_text'); ?></a>
      <?php   endwhile;
            endif; ?>
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

<div class="angle-left-large community-main">
  <div class="wrapper">
    <div class="clearfix mxn4">
      <div class="md-col md-col-6 px4">
        <h2 class="line line-gold line-long"><?php the_field('stats_section_heading') ?></h2>
        <?php the_field('stats_section_content') ?>
        <?php
          if( have_rows('stats_section_cta_buttons') ):
            while ( have_rows('stats_section_cta_buttons') ) : the_row(); ?>
            <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-white btn-white-on-dark" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn btn-white btn-white-on-dark mr2"><?php the_sub_field('button_text'); ?></a>
    <?php   endwhile;
          endif; ?>
      </div>
      <ul class="md-col md-col-6 list-reset px4 stats">
        <?php
        while ( have_rows('stats') ) : the_row(); ?>
        <li class="text-uppercase table py3">
          <span class="big-num"><?php the_sub_field('statistic') ?></span>
          <p class="m0 stats-font-style"><?php the_sub_field('statistic_content') ?></p>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>

    <div class="sm-col-12">
      <h3 class="line line-gold line-long light-gold-text h2">Community Affiliations</h3>
      <ul class="logo-list list-reset font-zero mxn3">
        <?php while ( have_rows('community_affiliations') ) : the_row(); ?>
          <?php if(get_sub_field('affiliation_link')) { ?>
            <a href="<?php the_sub_field('affiliation_link') ?>" target="_blank">
          <?php } ?>
              <li class="max-width-1 inline-block sm-col-3 md-col-2-5 my3 px3"><img src="<?php the_sub_field('affiliation_logo') ?>"></li>
          <?php if(get_sub_field('affiliation_link')) { ?>
            </a>
          <?php } ?>
        <?php endwhile; ?>
      </ul>
    </div>


  </div>
</div>

    <!-- BEGIN: Prefooter -->
    <?php get_template_part('pre-footer') ?>
    <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
