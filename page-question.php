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
	<div class="col-xs-12 col-md-8 page-question content-area">
		<div class="row"><h1>QUESTION OF THE WEEK</h1></div>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>">
			<?php query_posts('showposts=1&cat=69'); ?>
            <?php while (have_posts()) : the_post(); ?> 
            	<div class="row description-category">
				    <?php
				        $category_description = category_description();
				        if ( ! empty( $category_description ) )
				            echo '<div class="archive-meta">' . $category_description . '</div>';
				    ?>
				</div>
			<header class="entry-header row">
				<ul class="post-meta clearfix" >
					<li><?php the_time('M d, Y') ?></li>
				</ul>
				<?php if( get_field( "post_view_picture" ) ): ?>				
					<div class="post_view_picture"><img src="<?php the_field( "post_view_picture" ); ?>" alt=""></div>
				<?php endif;?>	
			</header>

			<div class="row">
				<span class="question">
					<?php the_field( "enter_question" ); ?></span>
				<?php if( get_field( "enter_answer" ) ): ?>			
				<p class="enter_answer">
					<?php the_field( "enter_answer" ); ?></p>
				<?php endif;?>			
				<div class="post-tags row">
					<?php the_tags('', '') ?></div>
			</div>

			<?php endwhile; ?>
            <?php wp_reset_query(); ?>
			<div class="entry-content row">

				<div class="show-posts">
					<?php query_posts('showposts=3&cat=18'); ?>				
					<div class="container-fluid">
					    <h3>PREVIOUS QUESTIONS:</h3>
					    <a href="/questions/" class="question-bank">Question Bank</a>
					</div>
					<?php while (have_posts()) : the_post(); ?>				
					<div class="col-xs-4">
						<a href="<?php the_permalink(); ?>">?</a>
						<p><a href="<?php the_permalink(); ?>"><?php the_field( "enter_question" ); ?></a></p>
					</div>
					<?php endwhile; ?>				
					<?php wp_reset_query(); ?>
				</div>
				
			</div><!-- entry-content -->

			<div class="ask-form col-xs-12">
			<h3>ask your questions</h3>
				<?php echo do_shortcode('[contact-form-7 id="525" title="ask your questions"]' ) ?>
			</div><!-- ask-form -->
		</article>

		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>
	<?php endwhile; // end of the loop. ?>
	</div><!-- content-area -->
</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
