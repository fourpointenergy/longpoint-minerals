<?php
/**
 * Page Name: About Us
 *
 */
global $lp_theme;
get_header(); ?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_About Us Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com/about-us/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp00;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp00;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="main-content" class="hero-wrap about-hero">
    <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
    <div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
      <div class="col sm-col-6 line line-gold line-long pb3 mb3 left-content">
        <h1 id="text-intro"><?php the_field('page_heading') ?></h1>
        <h2 class="text-uppercase text-elem"><?php the_field('page_subheading') ?></h2>
        <?php if( have_rows('mission_points') ): ?>
          <ol class="mission-list gold-text gold-list text-uppercase list-reset counter text-elem">
            <?php while ( have_rows('mission_points') ) : the_row(); ?>
            <li><?php the_sub_field('point_text'); ?></li>
    <?php   endwhile; ?>
          </ol>
          <?php endif; ?>
      </div>
      <div class="col sm-col-6 md-col-5 pb4 hero-secondary">
        <div class="pt2 line line-gold">
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </div>
    <?php if(get_field('quote_content')) { ?>
    <section class="quote quote-about">
<!--       <span class="swiper"></span> -->
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
    <!-- BEGIN: Team Archives -->
    <section class="team angle-left-large team-section py3">
      <div class="wrapper">
        <h3 class="mb3 mt0" id="team"><?php the_field('meet_the_team_headline'); ?></h3>
        <?php get_template_part('team-grid') ?>
      </div>
    </section>
    <!-- END: Team Archives -->

    <!-- BEGIN: Prefooter -->
    <?php get_template_part('pre-footer') ?>
    <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
