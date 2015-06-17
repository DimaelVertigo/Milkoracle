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
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<ul>
		<?php $pc = new WP_Query('orderby=date'); ?>
		<?php while ($pc->have_posts()) : $pc->the_post(); ?>
		<li>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="post-date"><?php the_time('M d, Y') ?></div>
				<div class="post-excerpt"><?php the_excerpt(); ?></div>
				<div class="post-title">
					<span><?php the_title(); ?></span>
				</div>
			</a>
		</li>
	 	<?php endwhile; ?>
	</ul>
	<?php endwhile; ?>
	<!-- post navigation -->
	<?php else: ?>
	<!-- no posts found -->
	<?php endif; ?> 
 

</main><!-- #main -->

<?php get_footer(); ?>
