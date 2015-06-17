<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Milkoracle
 */
?>
<div class="content-area col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
	<article id="post-<?php the_ID(); ?>
		"
		<?php post_class(); ?>
		>
		<header class="entry-header row">
			<?php the_title( '<h2 class="entry-title">', '</h1>
		' ); ?>
		</header>

		<div class="entry-content row">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' =>
			'
			<div class="page-links">
				' . __( 'Pages:', 'milkoracle' ),
					'after'  => '
			</div>
			',
				) );
			?>
		</div>

		<footer class="entry-footer row">
			<?php edit_post_link( __( 'Edit', 'milkoracle' ), '<span class="edit-link">', '</span>
		' ); ?>
		</footer>
	</article>
</div>