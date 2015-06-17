<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Milkoracle
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="col-xs-12 col-md-4 sidebar">
	<ul id="tab-triggers" class="row">
		<li class="selected">Popular</li>
		<li>Featured</li>
		<li>Tags</li>
	</ul>
	<div id="tabs">
		<div class="tab tab-1 active">
		<ul><?php
    function filter_where($where = '') {
        //posts in the last 30 days
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
        return $where;
    }
    add_filter('posts_where', 'filter_where');

    query_posts('post_type=post&posts_per_page=5&orderby=comment_count&order=DESC');

    while (have_posts()): the_post(); ?>
		<?php $attachment_id = get_field('upload_image');
        $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
        $image = wp_get_attachment_image_src( $attachment_id, $size );
        ?>
		<li>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="row">
					<div class="post-date"><?php the_time('M d, Y') ?></div>
				</div>
				<div class="row">
					<div class="post-thumbnail col-xs-6">
						<img src="<?php echo $image[0]; ?>"/>
					</div>
					<div class="post-title col-xs-6">
						<span><?php the_title(); ?></span>
					</div>
				</div>
			</a>
		</li>
	<?php endwhile;
    wp_reset_query();
    ?>
			</ul>
			<?php echo do_shortcode('[do_widget polls]'); ?>
		</div>

		<div class="tab tab-2" hidden>
			<ul><?php query_posts('showposts=5&cat=70'); ?>
				<?php while (have_posts()) : the_post(); ?>
				<?php $attachment_id = get_field('upload_image');
		        $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
		        $image = wp_get_attachment_image_src( $attachment_id, $size );
		        ?>
				<li>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<div class="row">
							<div class="post-date"><?php the_time('M d, Y') ?></div>
						</div>
						<div class="row">
							<div class="post-thumbnail col-xs-6">
								<img src="<?php echo $image[0]; ?>"/>
							</div>
							<div class="post-title col-xs-6">
								<span><?php the_title(); ?></span>
							</div>
						</div>
					</a>
				</li>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</ul>
			<?php echo do_shortcode('[do_widget polls]'); ?>
		</div>

		<div class="tab tab-3" hidden>
			<div class="tagcloud clearfix">
				<?php wp_tag_cloud() ?>
			</div>
				<?php echo do_shortcode('[do_widget polls]'); ?>

		</div>
	</div>
</div>
