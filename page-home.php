<?php
/**
 * Page Name: Home
 *
 */
global $lp_theme;
get_header(); ?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp0;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="main-content" class="hero-wrap home-hero">
    <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
    <div class="hero-inner px2" id="js-hero-height">
      <div class="md-col-6 inline-block line line-gold line-long">
        <h1 class="text-uppercase h1-home" id="text-intro"><?php the_field('page_heading') ?></h1>
        <h2 class="text-uppercase h5-blue-caps md-hide lg-hide text-elem"><?php the_field('page_subheading') ?></h2>
        <?php
          if( have_rows('cta_buttons') ):
            $count = 0;
            while ( have_rows('cta_buttons') ) :
              the_row(); ?>
              <a href="<?php the_sub_field('button_link'); ?>" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn <? if ($count > 0) { echo 'btn-grey'; } ?> mr2 text-elem left"><?php the_sub_field('button_text'); ?></a>
              <?php
              $count++;
            endwhile;
          endif; ?>
      </div>
      <div class="md-col-6 right px2 xs-hide sm-hide hero-secondary">
        <h3 class="text-uppercase h5-blue-caps px4 line line-gold"><span><?php the_field('page_subheading') ?></span></h3>
      </div>
    </div>
  </div>

  <div class="shale-section p0 relative">
    <div style="background-image: url(<?php $lp_theme->images_path(); ?>/shale-white-3.jpg)" class="shale-img">
      <div class="wrapper">
        <div class="push-right-40 sm-col-12">
          <h3 class="h5-blue-caps text-uppercase line line-gold" style="color:#5991A6"><?php the_field('section_heading'); ?></h3>
            <?php the_field('section_content'); ?>
            <?php
              if( have_rows('section_buttons') ):
                while ( have_rows('section_buttons') ) : the_row(); ?>
                <a href="<?php the_sub_field('button_link'); ?>" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="btn btn-gray"><?php the_sub_field('button_text'); ?></a>
                <?php   endwhile;
              endif; ?>
        </div>
      </div>
    </div>
  </div>

  <div class="home-bg-fixed" style="background-image: url(<?php $lp_theme->images_path(); ?>/wheat.jpg);">
    <div class="content-box-wrapper wrapper mx-auto my4 sm-col-10">
      <?php if(get_field('alternate_video')) { ?>
        <?php the_field('alternate_video'); ?>
      <?php } else { ?>
      <h2><?php the_field('home_section_3_heading'); ?></h2>
      <div class="content-box table mxn4">
        <?php
          if( have_rows('section_3_columns') ):
            while ( have_rows('section_3_columns') ) : the_row(); ?>
            <div class="md-col-6 px4 col">
              <h3 class="h5-blue-caps"><?php the_sub_field('column_heading'); ?></h3>
              <?php the_sub_field('column_content'); ?>
              <?php if(get_sub_field('learn_more_link')) { ?>
              <a href="<?php the_sub_field('learn_more_link') ?>" role="button" class="text-uppercase text-link text-link-arrow text-link-arrow-blue">Learn More</a>
              <?php } ?>
            </div>
          <?php   endwhile;
                endif; ?>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="pre-footer pre-footer-home relative">
    <div class="wrapper relative no-pad-side flex items-center" id="js-pf-fadeUp">
      <div class="home-pf-copy relative px3 pb2 sm-col-10 md-col-6 flex flex-wrap">
        <h4 class="h2 gold-text"><?php the_field('prefooter_header'); ?></h4>
        <?php the_field('prefooter_main_content'); ?>
      </div>
      <?php
        if( have_rows('prefooter_cards') ): ?>
      <div class="home-box-wrap md-col-6 flex flex-wrap">
        <?php
        while ( have_rows('prefooter_cards') ) : the_row(); ?>
        <?php if(get_sub_field('learn_more_link')) { ?>
        <a href="<?php the_sub_field('learn_more_link'); ?>" class="pre-footer-box relative flex my2 px3 mb3">
        <?php } ?>
          <div class="box-inner border-gold shadow-border box-blu-blk border-top px3 pt4 pb3">
            <?php $card_icon_arr = get_sub_field('card_icon'); ?>
            <img src="<?php echo $card_icon_arr['url'] ?>" class="pre-footer-icon" alt="<?php the_sub_field('card_heading'); ?>" />
            <h5 class="h5-pre-footer text-uppercase white-text"><?php the_sub_field('card_heading'); ?></h5>
            <?php the_sub_field('card_content'); ?>
            <?php if(get_sub_field('learn_more_link')) { ?>
            <p role="button" class="text-uppercase text-link text-link-arrow text-link-arrow-white">Learn More</p>
            <?php } ?>
          </div>
          <?php if(get_sub_field('learn_more_link')) { ?>
          </a>
          <?php } ?>
      <?php endwhile; ?>
      </div>
    <?php endif; ?>
    </div>
  </div>


<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
