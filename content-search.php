<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Milkoracle
 */
?>
 <?php $attachment_id = get_field('upload_image');
            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
            $image = wp_get_attachment_image_src( $attachment_id, $size );
            ?>
        <li class="col-xs-12 col-sm-6 col-md-4">
            <a href="<?php the_permalink(); ?>" class="post-link">
                <div class="post-img">
                   <? if (get_field('upload_image')): ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<div class="post-img"><img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></div>
					</a>
				<?php else: ?>
					<img src="no-photo.jpg" alt="">
				<? endif; ?>
                </div>
                <h3 class="post-title"><?php the_title(); ?></h3>
                <div class="hover_post_blockquote">
                    <?php echo wp_trim_words( get_the_content(), 20  ); ?>
                    <p><a href="<?php the_permalink(); ?>" class="read-more">Watch</a></p>
                </div> 
            </a>
        </li>
