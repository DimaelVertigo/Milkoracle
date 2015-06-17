<?php
get_header(); ?>
<div class="content-area inspiration col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">    
<main>
    <div class="row"><h1>Stories</h1>
    </div>
    
    <div class="featured">
        <div class="row">
            <h3>featured</h3>
        </div>
        <div class="row">
            <?php query_posts('showposts=1&post_type=stories&cat=61'); ?>
            <?php while (have_posts()) : the_post(); ?> 
            <?php $attachment_id = get_field('upload_image');
                    $size = "full"; // (thumbnail, medium, large, full or custom size)
                    $image = wp_get_attachment_image_src( $attachment_id, $size );
                    ?>    
            <img src="<?php echo $image[0]; ?>    
            " alt="" class="img-responsive">
            <div class="col-xs-12 col-sm-6">
                <a href="<?php the_permalink(); ?>">
                    <h3 class="post-title">
                        <?php the_title();?></h3>
                </a>
            </div>
            <div class="col-xs-12 col-sm-6 short-description">
                <?php the_field('short_description'); ?>
            </div>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>

    <div class="row"><h3>Trending</h3></div>
<ul class="row m-15">
    <?php
    function filter_where($where = '') {
        //posts in the last 30 days
        $where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
        return $where;
    }
    add_filter('posts_where', 'filter_where');

    query_posts('post_type=stories&posts_per_page=3&orderby=comment_count&order=DESC&cat=-61');

    while (have_posts()): the_post(); ?>

     <?php $attachment_id = get_field('upload_image');
            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
            $image = wp_get_attachment_image_src( $attachment_id, $size );
            ?>
            
            <li class="col-xs-12 col-sm-6 col-md-4">
                <a href="<?php the_permalink(); ?>" class="post-link">
                    <div class="post-img">
                        <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
                    </div>
                    <h3 class="post-title"><?php the_title(); ?></h3>
                    <div class="hover_post_blockquote">
                        <p><?php the_field( "short_description" ); ?>
                        </p>
                        <p><a href="<?php the_permalink(); ?>" class="read-more">Watch</a></p>
                    </div> 
                </a>
            </li>

    <?php
    endwhile;
    wp_reset_query();
    ?>
    </ul>
    <div class="row"><h3>Articles/Videos</h3></div>
    <?php 
    $cat = get_category( get_query_var( 'cat' ) );
    $category = $cat->slug;
    echo do_shortcode('[ajax_load_more post_type="stories" category__not_in="61"  posts_per_page="6" transition="fade"]');
    ?>
</main><!-- #main -->
</div>
<?php get_footer(); ?>
