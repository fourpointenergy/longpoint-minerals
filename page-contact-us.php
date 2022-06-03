<?php
/**
 * Page Name: Contact Us
 *
 */
global $lp_theme;
get_header(); ?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_Contact Us Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com/contact-us/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp002;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp002;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->


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
<div class="mt4 pt4 contact-page">
  <div class="wrapper clearfix mxn3">

    <!-- Contact form -->
    <div class="sm-col sm-col-5 px3 mt3">
      <?php if(get_field('form_area_content')) {
      	the_field('form_area_content');
      } ?>
    </div>

    <div class="sm-col-6 px3 right contact-cards">
    	<?php if(get_field('where_we_buy_content')) {
    	  	the_field('where_we_buy_content');
	      } ?>

    <div class="form-disclaimer">
      <p>If you're interested in contacting LongPoint Minerals, or in selling your minerals, you should contact LongPoint Minerals ONLY via its Headquarters address and phone number on this webpage, or by completing one of our inquiry forms. Please be advised that LongPoint Minerals DOES NOT:</p>
      <ul>
        <li>use any type of "chat" feature on third-party websites to communicate with any person or entity, including any mineral owner;</li>
        <li>and use instant messaging to initiate communications with mineral owners about selling minerals.</li>
      </ul>
      <p>LongPoint Minerals has no control over or responsibility for material on other websites about its services. LongPoint Minerals does not verify the information on other websites and does not endorse these sites or their source. Accordingly, users of this site should exercise caution and limit their communications with LongPoint Minerals to the methods recommended on this webpage.</p>
      <p>LongPoint Minerals expressly disclaims all liability for, and any damages of any kind, arising out of the use of, or reliance on, "chat" communications on third-party websites, or instant messaging. LongPoint Minerals also expressly disclaims all liability for, and any damages of any kind arising out of, the use of, or reliance on, purported advertisements or solicitations located on any third-party website. If any provision of this Disclaimer is found to be unenforceable under applicable law, said provision(s) will not affect the enforceability of any other provisions of the Disclaimer.</p>
    </div>

    </div>
  </div>
</div>

<div class="angle-left-large pb4 pt0 contact-page">
  <div class="wrapper clearfix mxn3">
    <?php if( have_rows('feature_cards') ):
        while ( have_rows('feature_cards') ) : the_row(); ?>
        <div class="sm-col sm-col-6 px3 pb4">
          <div class="feature-card my2">
            <a href="<?php the_sub_field('learn_more_link'); ?>" class="box-inner shadow-border box-white border-top border-gold px3 pt4 pb3">
              <?php $card_icon_arr = get_sub_field('card_icon'); ?>
              <img src="<?php echo $card_icon_arr['url'] ?>" class="pre-footer-icon" alt="<?php the_sub_field('card_heading'); ?>" />
              <h3 class="h5-pre-footer text-uppercase"><?php the_sub_field('card_heading'); ?></h3>
              <?php the_sub_field('card_content'); ?>
              <?php if(get_sub_field('learn_more_link')) { ?>
                <p role="button" class="text-uppercase text-link text-link-arrow">Learn More</p>
              <?php } ?>
            </a>
          </div>
        </div>
      <?php endwhile;
        endif;?>
  </div>
</div>
<?php get_template_part('pre-footer') ?>
<?php endwhile;// end of the loop. ?>
<?php get_footer(); ?>
