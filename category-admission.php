<?php
get_header(); ?>
<div class="content-area inspiration col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">    
<main>
    <div class="row">
        <h1>Admission</h1>
    </div>
    <div class="row description-category">
        <?php
            $category_description = category_description();
            if ( ! empty( $category_description ) )
                echo '<div class="archive-meta">' . $category_description . '</div>';
        ?>
    </div>
    <div class="featured">
        <div class="row">
            <h3>featured</h3>
        </div>
        <div class="row">
            <?php query_posts('showposts=1&cat=67'); ?>
            <?php while (have_posts()) : the_post(); ?> 
            <?php $attachment_id = get_field('upload_image');
                    $size = "full"; // (thumbnail, medium, large, full or custom size)
                    $image = wp_get_attachment_image_src( $attachment_id, $size );
                    ?>    
            <a href="<?php the_permalink(); ?>">             
                <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
            </a>
            <div class="col-xs-12 col-sm-6">
                <a href="<?php the_permalink(); ?>">
                    <h3 class="post-title m-15">
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

    query_posts('posts_per_page=3&orderby=comment_count&order=DESC&cat=-67,68');

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
                    <p>
                        <span class="post-views">
                            <?php echo do_shortcode( '[post_view]' ) ?></span>
                        <span class="post-date">
                            <?php the_time('j F Y' ); ?></span>
                    </p>
                    <div class="hover_post_blockquote">
                        <p><?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?>
                        </p>
                        <p>
                            <?php if( get_field( "button_label" ) ): ?>                
                            <a href="<?php the_permalink(); ?>" class="read-more"><?php the_field( "button_label" ); ?></a>
                            <?php else: ?>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read</a>
                            <?php endif;?>    
                        </p>
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
    echo do_shortcode('[ajax_load_more category="show-career-on-admission,show-college-life-on-admission,show-stories-on-admission,trending-admission" category__not_in="67"  posts_per_page="6" transition="fade"]');
    ?>
</main><!-- #main -->
</div>
<?php get_footer(); ?>
