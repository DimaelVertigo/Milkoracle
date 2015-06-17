<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Milkoracle
 */

get_header(); ?>

<div id="primary" class="content-area page-404 col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
	<div class="header-404 row">
		<div class="col-xs-12 col-lg-4 page-name">404</div>
		<div class="col-xs-12 col-lg-4 page-desc">Ooops, looks like there is no such page. 
You can go back to <a href="<?php echo home_url(); ?>">Main Page</a></div>
		<div class="col-xs-12 col-lg-1 col-lg-offset-1 page-logo"><a href="<?php echo home_url(); ?>"></a></div>
	</div>
	<div class="content-block content-block-big container">
		<h3> it may be interesting for you to check:</h3>
		<ul>
			<?php query_posts(
				array(
			     'cat' => 70,
			     'showposts' => 3 )
			    ); ?>
			<?php while (have_posts()) : the_post(); ?>
			<?php $attachment_id = get_field('upload_image');
			            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
			            $image = wp_get_attachment_image_src( $attachment_id, $size );
			            ?>
			<li class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
				<a href="<?php the_permalink(); ?>
					" class="post-link">
					<div class="post-img">
						<img src="<?php echo $image[0]; ?>"/></div>
					<div class="post-inner">
						<h4 class="post-title">
							<?php the_title(); ?></h4>

						<span class="author-name">
							<?php the_author(); ?></span>

						<div class="post_blockquote">
							<p>
								<?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
						</div>
						<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
					</div>
				</a>
				<!-- post-link -->
			</li>
			<?php endwhile; ?>
			<?php wp_reset_query(); ?></ul>
	</div>
</div>
<!-- #primary -->

<?php get_footer(); ?>