<?php
/**
 * Page Name: Selling Your Minerals
 *
 */
global $lp_theme;
get_header(); ?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_Selling Your Minerals Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com/selling-your-minerals/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp001;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp001;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <div id="main-content" class="hero-wrap less-height">
    <img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
    <div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
      <div class="sm-col-6 md-col-7 inline-block line line-gold line-long">
        <h1 class="mb4" id="text-intro"><?php the_field('page_heading') ?></h1>
      </div>
      <?php
        if( have_rows('cards') ): ?>
      <div class="mx-auto card-wrapper">
        <?php
        $index = 0;
        while ( have_rows('cards') ) : the_row(); $index++; ?>
          <div class="inner shadow-border card-bottom grid-col-<? echo $index; ?>"></div>
          <?php $card_image = get_sub_field('card_image'); ?>
          <div class="card-image grid-col-<? echo $index; ?>" role="image" alt="<?php the_sub_field('card_heading') ?>" style="background-image:url(<?php echo $card_image['url'] ?>);"></div>
          <h2 class="px2 text-uppercase center card-header grid-col-<? echo $index; ?>"><?php the_sub_field('card_heading') ?></h2>
          <div class="card-copy pb2 grid-col-<? echo $index; ?>">
            <?php the_sub_field('card_content') ?>
          </div>
        <?php endwhile; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php if(get_field('quote_content')) { ?>
  <section class="quote quote-about quote-selling">

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
<!-- BEGIN: Stats Section -->
<section class="angled-bg-img white-text<?php if(get_field('page_background_overlay_color')) { ?> overlay overlay-<?php the_field('page_background_overlay_color') ?>"<?php } ?> style="background-image: url(<?php the_field('page_background_image') ?>);">
  <div class="wrapper angled-selling-wrapper">
    <div class="clearfix mxn4">
      <div class="md-col md-col-6 px4">
        <h2 class="line line-gold line-long<?php if(get_field('page_background_overlay_color')=='gold' || get_field('page_background_overlay_color')=='dk-blue') { ?> white-text<?php } ?>"><?php the_field('stats_section_heading') ?></h2>
        <span class="<?php if(get_field('page_background_overlay_color')=='gold' || get_field('page_background_overlay_color')=='dk-blue') { ?> white-text<?php } ?>"><?php the_field('stats_section_content') ?></span>
        <?php
          if( have_rows('stats_section_cta_buttons') ):
            while ( have_rows('stats_section_cta_buttons') ) : the_row(); ?>
            <a href="<?php the_sub_field('button_link'); ?>" class="btn<?php if(get_field('page_background_overlay_color')=='gold' || get_field('page_background_overlay_color')=='dk-blue') { ?> btn-white btn-white-on-dark<?php } ?>" role="button"<?php if(get_sub_field('button_target')) { echo(' target="'.get_sub_field('button_target')[0].'"'); } ?> class="text-uppercase btn btn-white btn-white-on-dark mr2"><?php the_sub_field('button_text'); ?></a>
    <?php   endwhile;
          endif; ?>
      </div>
      <ul class="md-col md-col-6 list-reset px4 stats">
        <?php
        while ( have_rows('stats') ) : the_row(); ?>
        <li class="text-uppercase table py3">
          <span class="big-num<?php if(get_field('page_background_overlay_color')=='gold' || get_field('page_background_overlay_color')=='dk-blue') { ?> white-text<?php } ?>"><?php the_sub_field('statistic') ?></span>
          <p class="m0 stats-font-style"><?php the_sub_field('statistic_content') ?></p>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>
  </div>
</section>
<!-- END: Stats Section -->
<!-- BEGIN: Selling Form -->
<div class="selling-form-wrap pt4">
  <div class="wrapper clearfix">
    <div class="sm-col-12 mxn3">
      <?php the_field('sell_form_content'); ?>
    </div>

    <!-- This is the form. It is not labeled correctly -->
    <div class="sm-col-12">
      <?php if(get_field('where_we_buy_content')) {
        the_field('where_we_buy_content');
      } ?>
    </div>
  </div>
</div>
<div class="form-disclaimer minerals-page">
  <div class="wrapper clearfix">
    <p>If you're interested in selling your minerals, you should contact LongPoint Minerals ONLY via its address and phone number on this webpage, or by completing one of our inquiry forms. Please be advised that LongPoint Minerals DOES NOT:</p>
    <ul>
      <li>use any type of "chat" feature on third-party websites to communicate with any person or entity, including any mineral owner;</li>
      <li>and use instant messaging to initiate communications with mineral owners about selling minerals.</li>
    </ul>
    <p>LongPoint Minerals has no control over or responsibility for material on other websites about its services. LongPoint Minerals does not verify the information on other websites and does not endorse these sites or their source. Accordingly, users of this site should exercise caution and limit their communications with LongPoint Minerals to the methods recommended on this webpage.</p>
    <p>LongPoint Minerals expressly disclaims all liability for, and any damages of any kind, arising out of the use of, or reliance on, "chat" communications on third-party websites, or instant messaging. LongPoint Minerals also expressly disclaims all liability for, and any damages of any kind arising out of, the use of, or reliance on, purported advertisements or solicitations located on any third-party website. If any provision of this Disclaimer is found to be unenforceable under applicable law, said provision(s) will not affect the enforceability of any other provisions of the Disclaimer.</p>
  </div>
</div>
<!-- END: Selling Form -->


    <!-- BEGIN: Prefooter -->
    <?php get_template_part('pre-footer') ?>
    <!-- END: Prefooter -->
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
