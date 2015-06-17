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
	<div class="content-area front-page">
		<main>
		<?php if ( have_posts() ) : ?>		
		<div class="content-block content-block-big container featured-articles">
			<h3>Featured</h3>
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
					<a href="<?php the_permalink(); ?>" class="post-link">
						<div class="post-img"><img src="<?php echo $image[0]; ?>"/>
						</div>
						<div class="post-inner">
							<h4 class="post-title"><?php the_title(); ?></h4>

							<span class="author-name"><?php the_author(); ?></span>

							<div class="post_blockquote"> 
								<p><?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
							</div>
							<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
						</div>
					</a><!-- post-link -->
				</li>
				<?php endwhile; ?>		
				<?php wp_reset_query(); ?>			
			</ul>
		</div>	
		<div class="content-block content-block-small row trending-articles">
			<h3>Trending articles</h3>
		
			<ul class="col-xs-12">
				<?php

			    query_posts('posts_per_page=4&meta_key=views&orderby=meta_value_num&order=DESC&cat=-17,-18,-15,-40');

			    while (have_posts()): the_post(); ?>
				<?php $attachment_id = get_field('upload_image');
	            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
	            $image = wp_get_attachment_image_src( $attachment_id, $size );
	            ?>		

				<li class="col-xs-12 col-sm-6 col-md-3">
					<a href="<?php the_permalink(); ?>" class="post-link">
						<div class="post-img">
							<img src="<?php echo $image[0]; ?>" class="img-responsive"/>
						</div><!-- post-img -->
						<div class="post-inner">
							<h3 class="post-title"><?php the_title(); ?></h3>
							<span class="author-name">By <?php the_author(); ?></span>
							<div class="views" data-views="<?php echo do_shortcode( '[post_view]' ) ?>"></div>
							<span class="date"><?php the_time('j F Y' ); ?></span>
							<div class="hover_post_blockquote">
								<p>
									<?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
								</p>
							</div>
						</div><!-- post-inner -->
					</a>
				</li>
				<?php
			    endwhile;
			    wp_reset_query();
			    ?>			
			</ul>
		</div>	

		<div class="content-block content-block-small row trending-video">
			<h3>Trending VIDEO</h3>
			<ul class="col-xs-12">
				<?php query_posts('posts_per_page=4&meta_key=views&orderby=meta_value_num&order=DESC&cat=15');?>		
				<?php while (have_posts()) : the_post(); ?>	
				<?php $attachment_id = get_field('upload_image');
	            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
	            $image = wp_get_attachment_image_src( $attachment_id, $size );
	            ?>		


				<li class="col-xs-12 col-sm-6 col-md-3">
					<a href="<?php the_permalink(); ?>
						" class="post-link">
						<div class="post-img">
							<img src="<?php echo $image[0]; ?>"/></div>
						<!-- post-img -->				
						<div class="post-inner"><h3 class="post-title"><?php the_title(); ?></h3>
							<span class="author-name">By <?php the_author(); ?></span>
							<div class="views" data-views="<?php echo do_shortcode( '[post_view]' ) ?>"></div>
								<span class="date"><?php the_time('j F Y' ); ?></span>
							<div class="hover_post_blockquote">
								<p>
									<?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
								<p>
									<a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
								</p>
							</div><!-- hover_post_blockquote -->
						</div>
						<!-- post-inner -->				
					</a>
				</li>	
				<?php endwhile; ?>		
				<?php wp_reset_query(); ?>			
			</ul>
		</div>

		<div class="content-block content-block-small row coming-soon">
			<h3>Coming soon</h3>
			<ul class="col-xs-12">
				<?php query_posts('showposts=8&cat=17'); ?>		
				<?php while (have_posts()) : the_post(); ?>	
				<?php $attachment_id = get_field('upload_image');
	            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
	            $image = wp_get_attachment_image_src( $attachment_id, $size );
	            ?>	

				<li class="col-xs-12 col-sm-6 col-md-3">
					<a href="<?php the_permalink(); ?>
						" class="post-link">
						<div class="post-img">
							<img src="<?php echo $image[0]; ?>"/></div>
						<!-- post-img -->				
						<div class="post-inner"><h3 class="post-title"><?php the_title(); ?></h3>
							<span class="author-name">By <?php the_author(); ?></span>
								<span class="date"><?php the_time('j F Y' ); ?></span>
							<div class="hover_post_blockquote">
								<p>
									<?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?>
								</p>
								
							</div><!-- hover_post_blockquote -->
						</div>
						<!-- post-inner -->				
					</a>
				</li>	

				<?php endwhile; ?>		
				<?php wp_reset_query(); ?>			
			</ul>
		</div>
			
		
				
		<div class="contact-form row">
			<div class="contact-form-slogan">
				<span>Subscribe </span>
				<span>for updates</span>
			</div>
			
			<!-- Begin MailChimp Signup Form -->			
			<div id="mc_embed_signup">
				<form action="//milkoracle.us10.list-manage.com/subscribe/post?u=075287807ab61e4bc179086fc&amp;id=8a9c3bcd33" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
					<div id="mc_embed_signup_scroll">
						<ul class="form">
							<li class="mc-field-group">
								<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
							</li>
							<li>
								<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<!--End mc_embed_signup-->			
		</div>
		<!-- contact-form -->
		<?php else : ?>		
		<?php endif; ?>		
		</main><!-- #main -->
	</div>
	

<?php get_footer(); ?>


