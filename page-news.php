<?php
/**
 *
 * Page Name: News
 *
 */
global $lp_theme;
get_header();
if ( have_posts() ) while ( have_posts() ) : the_post();
// $page_content = get_posts($args)[0];
?>


<!--
Start of DoubleClick Floodlight Tag: Please do not remove
Activity name of this tag: LongPoint Minerals_LP Features Landing Page
URL of the webpage where the tag is expected to be placed: http://www.longpointminerals.com/longpoint-features/
This tag must be placed between the <body> and </body> tags, as close as possible to the opening tag.
Creation Date: 08/28/2017
-->
<script type="text/javascript">
var axel = Math.random() + "";
var a = axel * 10000000000000;
document.write('<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp003;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=' + a + '?" width="1" height="1" frameborder="0" style="display:none"></iframe>');
</script>
<noscript>
<iframe src="https://8063531.fls.doubleclick.net/activityi;src=8063531;type=fy17a0;cat=longp003;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;ord=1?" width="1" height="1" frameborder="0" style="display:none"></iframe>
</noscript>
<!-- End of DoubleClick Floodlight Tag: Please do not remove -->


<!-- Longpoint Features Template -->

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
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>
  <div class="wrapper search-wrap mt4 clearfix">
    <div class="sm-col sm-col-12 md-col-6 pt2">
      <form role="search" name="searchform" class="searchform" action="/" method="get">
        <p>
           <label for="search-features">Search</label>
           <input type="text" name="s" id="search-features" class="search-input search-icon my2 relative" value="">
         </p>
         <p class="search-submit">
           <input type="submit" name="search-submit" id="search-submit" class="btn btn-gray text-uppercase" value="Search">
         </p>
       </form>
    </div>

    <div class="sm-col sm-col-12 md-col-6 pt2 pb4 search-right">
      <p>
        <label for="feature-category-select" class="mb1 block">Filter</label>
      </p>
      <?php
      $terms = get_terms( array(
        'taxonomy' => 'feature_category',
        'hide_empty' => true,
      ) );
      ?>
      <select id="feature-category-select" name="topic">
        <option value="category">Select a Category</option>
        <?php foreach($terms as $category) { ?>
        <option value="<?php echo $category->slug ?>"><?php echo $category->name ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
<?php
$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$args = array(
  'post_type' => 'longpoint-feature',
  'meta_key' => 'feature_date',
  'orderby' => 'meta_value_num',
  'order' => 'DESC',
  'post_status' => 'publish',
  'paged' => $paged
);

if(get_query_var('filter')) {
  $filter = get_query_var('filter');
  $tax_query = array(
    array(
      'taxonomy' => 'feature_category',
      'field' => 'slug',
      'terms' => $filter
    )
  );
  if($filter && $filter != '') {
    $args['tax_query'] = $tax_query;
  }
}
$wp_query = new WP_Query( $args );
?>
<?php if ( have_posts() ) : ?>
    <div class="angle-left-large pb4 no-angle-top">
    <div class="wrapper">
      <ul class="list-reset feature-cards">
        <?php while ( have_posts() ) : the_post(); ?>
        <li class="feature-card">
          <?php
          $feature_link = '#';
          $feature_link_target = "_self";
          if( get_field('feature_link_target') ) {
            $feature_link_target = get_field('feature_link_target');
          }
          if( get_field('feature_pdf') ) {
            $feature_link = get_field('feature_pdf');
            $feature_link_target = '_blank';
          } else {
            if( get_field('feature_link') ) {
              $feature_link = get_field('feature_link');
            }
          }
          $post_terms_obj = wp_get_post_terms( $post->ID, 'feature_category' );
          $post_terms = array();
          foreach($post_terms_obj as $post_term_obj) {
            array_push($post_terms,$post_term_obj->name);
          }
          ?>
          <a href="<?php echo $feature_link ?>" target="<?php echo $feature_link_target ?>" class="box-inner shadow-border box-white border-top border-gold px3 pt2 pb3">
            <p class="date-category light-gold-text"><?php the_field('feature_date') ?> <? if (count($post_terms) > 0) { ?> | <span class="category"><?php echo implode(", ",$post_terms) ?></span><? } ?></p>
            <h2 class="text-uppercase"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <?php if($feature_link != '#') { ?>
            <p role="button" class="text-uppercase text-link text-link-arrow">Learn More</p>
            <?php } ?>
          </a>
        </li>
      <?php endwhile; ?>
      </ul>

      <?php
      if(function_exists('wp_paginate')) {
        wp_paginate();
      }
      ?>

    </div>
  </div>
  <?php wp_reset_query(); ?>
<?php endif; ?>
    <!-- BEGIN: Prefooter -->
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <?php get_template_part('pre-footer') ?>
  <?php endwhile; ?>
    <!-- END: Prefooter -->

<?php get_footer(); ?>
