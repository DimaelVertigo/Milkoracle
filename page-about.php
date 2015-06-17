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

		<main>
			<div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0 page-about content-area">
				<h1><?php the_title(); ?></h1>
				<section>
					<?php the_content(); ?>
				</section>
			</div>
		</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
