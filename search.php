<?php

/**
 * Template for displaying Feature Search Results
 */
global $lp_theme;
global $wp_query;

get_header();
?>
<!-- Longpoint Features Template -->
<div class="hero-wrap">
	<img src="<?php $lp_theme->images_path(); ?>/slate.jpg" class="slateimg" id="js-img-height" alt="" />
	<div class="hero-inner px2 clearfix wrapper" id="js-hero-height">
		<div class="col sm-col-6 line line-gold line-long pb3 pr4 mb3">
			<h1 id="text-intro">
				<?php if ( get_search_query() ) : ?>
					Search Results for &ldquo;<?= get_search_query(); ?>&rdquo;
				<?php else: ?>
					Search Results
				<?php endif; ?>
			</h1>
		</div>
		<div class="col sm-col-6 md-col-5 pb4">
			
		</div>
	</div>
</div>
<div class="wrapper search-wrap mt4 clearfix">
	<div class="sm-col sm-col-12 md-col-6 pt2">
		<form role="search" name="searchform" class="searchform" action="/" method="post">
			<p>
				<label for="search-features">Search</label>
				<input type="text" name="s" id="search-features" class="search-input search-icon my2 relative" value="<?php the_search_query(); ?>">
			</p>
			<p class="search-submit">
				<input type="submit" name="search-submit" id="search-submit" class="btn btn-gray text-uppercase" value="Search">
			</p>
		</form>
	</div>

	<?php 
	/*
	// filter not working, removing for now (5-6-22)
	<div class="sm-col sm-col-12 md-col-6 pt2 pb4 search-right">
		<p>
			<label for="feature-category-select" class="mb1 block">Filter</label>
		</p>
		<?php
		$terms = get_terms(array(
			'taxonomy' => 'feature_category',
			'hide_empty' => true,
		));
		?>
		<select id="feature-category-select" name="topic">
			<option>Select a Category</option>
			<?php foreach ($terms as $category) { ?>
				<option value="<?php echo $category->slug ?>"><?php echo $category->name ?></option>
			<?php } ?>
		</select>
	</div>
	*/
	?>
</div>

<div class="angle-left-large pb4 no-angle-top">
	<div class="wrapper">
		<?php
		$the_query = new WP_Query( 
			array(
				's' => get_search_query()
			) 
		);
		if ( $the_query->have_posts() ) : ?>
			<ul class="list-reset sm-flex card-wrap flex-wrap justify-center content-end mxn3">
				<?php while ( $the_query->have_posts() ) :
					$the_query->the_post(); 
					
					if ($post->post_type == 'longpoint-feature') { ?>
						<li class="feature-card my2 sm-col-6 px3 pb1">
							<?php
							$feature_link = '#';
							$feature_link_target = "_self";
							if (get_field('feature_link_target')) {
								$feature_link_target = get_field('feature_link_target');
							}
							if (get_field('feature_pdf')) {
								$feature_link = get_field('feature_pdf');
								$feature_link_target = '_blank';
							} else {
								if (get_field('feature_link')) {
									$feature_link = get_field('feature_link');
								}
							}
							$post_terms_obj = wp_get_post_terms($post->ID, 'feature_category');
							$post_terms = array();
							foreach ($post_terms_obj as $post_term_obj) {
								array_push($post_terms, $post_term_obj->name);
							}
							?>
							<a href="<?php echo $feature_link ?>" target="<?php echo $feature_link_target ?>" class="box-inner shadow-border box-white border-top border-gold px3 pt2 pb3">
								<p class="date-category light-gold-text"><?php the_field('feature_date') ?> | <span class="category"><?php echo implode(", ", $post_terms) ?></span></p>
								<h3 class="text-uppercase"><?php the_title(); ?></h3>
								<?php the_content(); ?>
								<?php if ($feature_link != '#') { ?>
									<p role="button" class="text-uppercase text-link text-link-arrow">Learn More</p>
								<?php } ?>
							</a>
						</li>
					<?php } ?>
				<?php endwhile; ?>
			</ul>
		<?php else : ?>
			<div class="search-results-empty-message" style="min-height:400px;">
				<p>Sorry, no search results were found.</p>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php
$prefooter_pageid = $page_content->ID;
include('pre-footer.php') ?>
<?php get_footer(); ?>