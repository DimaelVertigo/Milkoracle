<?php
/**
 * The template for displaying search results pages.
 *
 * @package Milkoracle
 */

get_header(); ?>

	<section id="primary" class="inspiration col-xs-10 col-xs-offset-1 col-md-12 col-md-offset-0 search-list content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'milkoracle' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->
			<ul class="row">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			
		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
		</ul>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
