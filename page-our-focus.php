<?php
/**
 * Page Name: Our Focus
 *
 */
global $lp_theme;
get_header(); ?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_Our Focus Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com/our-focus/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp000;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp000;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="main-content" class="hero-wrap less-height">
    <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
    <div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
      <div class="sm-col-6 inline-block line line-gold line-long">
        <h1 class="mb4" id="text-intro"><?php the_field('page_heading') ?></h1>
      </div>
      <div class="embed-container">
        <div class="embed-shader"></div>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
    <section class="quote angle-right-small<?php if(get_field('page_background_overlay_color')) { ?> overlay overlay-<?php the_field('page_background_overlay_color') ?>"<?php } ?> style="background-image: url(<?php the_field('page_background_image') ?>);">
      <div class="wrapper">
        <div class="sm-col-12 push-right">
          <h2 class="text-uppercase white-text"><?php the_field('section_content_headline') ?></h2>
          <span class="white-text"><?php the_field('section_content') ?></span>
          <?php
            if( have_rows('section_cta_button') ):
              while ( have_rows('section_cta_button') ) : the_row(); ?>
              <a href="<?php the_sub_field('button_link'); ?>" class="text-uppercase btn btn-white btn-white-on-dark max-width-1" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn btn-white btn-white-on-dark mr2"><?php the_sub_field('button_text'); ?></a>
      <?php   endwhile;
            endif; ?>
        </div>
      </div>
</section>

<!-- BEGIN: Accordion Section Area -->
<a name="strategy"></a>
<div class="angle-left-large py4">
  <div class="wrapper">
    <div class="clearfix mxn3">
      <div class="md-col md-col-6 px3 mb4">
        <h3 class="light-gold-text line line-gold"><?php the_field('section_2_content_headline'); ?></h3>
        <p><?php the_field('section_2_content'); ?></p>
      </div>
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
<!-- END: Accordion Section Area -->



    <!-- BEGIN: Prefooter -->
    <?php get_template_part('pre-footer') ?>
    <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
