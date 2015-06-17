<?php
/**
 * @package Milkoracle
 */
?>

<article class="col-xs-12 col-sm-6" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<a href="<?php the_permalink(); ?>" class="post-link">
		<?php if( get_field('content_block_1_post') ): ?>		
		<?php while( has_sub_field('content_block_1_post') ): ?>
		
			<div class="post-img">
				<img src="<?php the_sub_field('post_picture'); ?>" width="100%"/>
			</div>
			<h3><?php the_title( ); ?></h3>
			<?php the_excerpt();?>

		<?php endwhile; ?>		
		<?php endif;?>
		</a>
		
	</div><!-- .entry-content -->
	<?php the_posts_pagination() ?>

</article><!-- #post-## -->