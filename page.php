<?php
/**
 * Page Name: Template for displaying all pages
 *
 */
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
      <div class="col sm-col-6 md-col-5 pb4">
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
    <?php if(get_field('quote_content')) { ?>
    <section class="quote quote-about">
      <div class="wrapper">
        <div class="center bquote-wrap pt4">
          <blockquote class="blockquote blockquote-copy italic mx-auto"><span class="relative block"><?php the_field('quote_content'); ?></span>
          <?php if(get_field('quote_citation')) { ?>
          <cite class="blockquote-cite block" title="Source Title">&mdash; <?php the_field('quote_citation'); ?></cite>
          <?php } ?>
        </div>
      </div>
    </section>
  <?php } ?>

  <!-- BEGIN: Accordion Section Area -->
  <?php if( have_rows('accordion') ): ?>
  <div class="angle-left-large py4">
    <div class="wrapper">
      <div class="clearfix mxn3">
        <div class="md-col md-col-6 px3 accordion-container
        ">
          <?php
            if( have_rows('accordion') ): ?>
          <ul>
            <?php while ( have_rows('accordion') ) : the_row(); ?>
            <li>
              <a href="javascript:;" class="accordion-title"><?php the_sub_field('item_title'); ?><img src="<?php $lp_theme->images_path() ?>/icon-plus-lightblue.svg" class="accordion-plus-minus" alt="show more icon"/></a>
              <div class="accordion-content">
                <?php the_sub_field('item_content'); ?>
              </div>
            </li>
            <?php endwhile; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <!-- END: Accordion Section Area -->

    <!-- BEGIN: Prefooter -->
    <?php get_template_part('pre-footer') ?>
    <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
