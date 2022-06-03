<?php
/**
 * Loop for the team grid
**/
$args = array(
  'post_type' => 'team',
  'order' => 'menu_order',
  'post_status' => 'publish',
  'posts_per_page' => -1
);
global $lp_theme, $post;
$team_qry = new WP_Query( $args );
if ( $team_qry->have_posts() ) : ?>
<ul class="team-member-wrapper list-reset relative flex flex-wrap">
<?php while ( $team_qry->have_posts() ) : $team_qry->the_post(); ?>
  <li class="team-member sm-col-6 md-col-4 mb3 flex">
    <a href="<?php the_permalink(); ?>" rel="team-detail-<?php echo $post->ID ?>" class="team-modal-open">
      <div class="box-inner m2 shadow-border pb2">
        <?php $profile_photo_arr = get_field("profile_photo"); ?>
        <span class="blue-overlay-team block">
          <img src="<?php echo $profile_photo_arr['url'] ?>" class="member-img" alt="<?php the_title(); ?>"/>
        </span>
        <div class="center px2">
          <h3 class="text-uppercase mb1"><?php the_title(); ?></h3>
          <p class="mt0"><?php the_field("profile_position") ?></p>
          <a href="<?php the_permalink(); ?>" rel="team-detail-<?php echo $post->ID ?>" class="text-link text-link-plus text-uppercase team-modal-open">More<img src="<?php $lp_theme->images_path() ?>/icon_plus.svg" alt="show more detail icon" /></a>
        </div>
      </div>
    </a>
  </li>
<?php endwhile; ?>
</ul>
<!-- Team member detail modals -->
<?php while ( $team_qry->have_posts() ) : $team_qry->the_post(); ?>
  <?php $profile_photo_arr = get_field("profile_photo"); ?>
    <div class="fixed overflow-auto team-overlay-background" id="team-detail-<?php echo $post->ID ?>">
      <div class="team-overlay-shader"></div>
      <div class="inside team-member-overlay">
        <div class="wrapper">
          <div class="detail-inner px2 py4">
            <span class="blue-overlay-team block">
              <img src="<?php echo $profile_photo_arr['url'] ?>" alt="<?php the_title(); ?>" class="block"/>
            </span>
            <h3 class="text-uppercase mb0 relative sm-col-8 md-col-7 lg-col-6"><?php the_title(); ?></h3>
            <a href="#" class="text-link text-uppercase team-close align-middle">Close<img src="<?php $lp_theme->images_path() ?>/icon_minus.svg" class="inline-block align-middle ml1" alt="close detail icon" /></a>
            <div class="sm-col-11 md-col-9">
              <p class="mt0 team-title"><?php the_field("profile_position") ?></p>
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php endwhile; ?>
<?php endif; ?>
<?php wp_reset_query(); ?>
