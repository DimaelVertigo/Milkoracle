<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Milkoracle
 */

get_header(); ?>
	
<div id="primary" class="content-area col-xs-12 page-ask">
	<main>
	
		<?php while ( have_posts() ) : the_post(); ?>

		<header class="row">
				<h1 class="col-xs-4"><?php the_title(); ?></h1>
				<?php if( get_field( "title_description" ) ): ?>				
					<p class="title-description col-xs-6 col-xs-offset-1">
						<?php the_field( "title_description" ); ?>
					</p>
				<?php endif;?>	
		</header>

		<div class="content row">
			<a href="<?php echo home_url(); ?>/question" class="col-xs-12 col-md-6 ask-link ask-link-1">
				<span>QN OF<br>THE WEEK</span>
			</a>
			<a href="#" class="col-xs-12 col-md-6 ask-link ask-link-2">
				<span>Upcoming Events</span>
			</a>
		</div>
		
		<?php endwhile; // end of the loop. ?>
	</main>
</div><!-- #primary -->

<?php get_footer(); ?>
