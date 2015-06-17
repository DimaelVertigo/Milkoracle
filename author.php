<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Milkoracle
 */

get_header(); ?>
<div id="primary" class="content-area col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0 author">
	<main id="main" class="site-main row" role="main">

		<?php
	/* Queue the first post, that way we know who
	 * the author is when we try to get their name,
	 * URL, description, avatar, etc.
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

		<?php
// If a user has filled out their description, show a bio on their entries.
if ( get_the_author_meta( 'description' ) ) : ?>
		<div id="entry-author-info">
			<div id="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?></div>
			<!-- #author-avatar -->
			<div id="author-description">
				<h1>
 
                </h3>
					<?php printf( __( 'About %s', 'twentyten' ), get_the_author() ); ?></h1>
				<?php the_author_meta( 'description' ); ?></div>
			<!-- #author-description	-->
		</div>
		<!-- #entry-author-info -->
		<?php endif; ?>

		<?php if (have_posts()) : ?>
		<?php if (is_month()) {query_posts('year='.get_the_time('Y').'&monthnum='.get_the_time('m').'&author_name=admin&cat=1&posts_per_page='.get_option('posts_per_page')); ?>
		<?php } ?>
		<?php while (have_posts()) : the_post(); ?>
		<div class="col-xs-12 col-sm-6 col-md-4 col-lg-12 post">
			<a href="<?php the_permalink(); ?>" class="post-link">
				<div class="post-img"><?php the_post_thumbnail(array()); ?>
				</div>
				<div class="post-inner">
					<h3 class="post-title"><?php the_title(); ?></h3>
					<div class="post_blockquote"><?php the_excerpt(); ?></div>
				</div>
			</a><!-- post-link -->
		</div>
		<?php endwhile; ?>
		<?php endif; ?>
		<?php kriesi_pagination(); ?></main>
	<!-- #main -->
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>