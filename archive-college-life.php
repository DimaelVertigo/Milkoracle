<?php
get_header(); ?>
<div class="content-area inspiration col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
    <main>
        <div class="row">
            </h3>College life</h1>
        </div>
        <div class="featured">
            <div class="row">
                <h3>featured</h3>
            </div>
            <div class="row">
               
                    <?php query_posts('showposts=1&post_type=college-life&cat=57'); ?>                
                    <?php while (have_posts()) : the_post(); ?>                
                    <?php $attachment_id = get_field('upload_image');
                    $size = "full"; // (thumbnail, medium, large, full or custom size)
                    $image = wp_get_attachment_image_src( $attachment_id, $size );
                    ?>  
                    <a href="<?php the_permalink(); ?>
                        "><img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></a>
                    <a href="<?php the_permalink(); ?>
                        " class="col-xs-12 col-sm-5">
                        <h3 class="post-title">
                            <?php the_title();?></h3>
                    </a>
                    <div class="col-xs-12 col-sm-6 col-sm-offset-1 short-description">
                        <?php the_field('short_description'); ?></div>
                    <?php endwhile; ?>                
                    <?php wp_reset_query(); ?>
            </div>
        </div>

        <div class="row">
            <h3>Trending</h3>
        </div>
        <ul class="row">
            <?php
    function filter_where($where = '') {
        //posts in the last 30 days
        $where .= " AND post_date >
            '" . date('Y-m-d', strtotime('-30 days')) . "'";
        return $where;
    }
    add_filter('posts_where', 'filter_where');

    query_posts('post_type=college-life&posts_per_page=3&orderby=comment_count&order=DESC&cat=-57');

    while (have_posts()): the_post(); ?>
            <?php $attachment_id = get_field('upload_image');
            $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
            $image = wp_get_attachment_image_src( $attachment_id, $size );
            ?>

            <li class="col-xs-12 col-sm-6 col-md-4">
                <a href="<?php the_permalink(); ?>
                    " class="post-link">
                    <div class="post-img">
                        <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></div>
                    <h3 class="post-title">
                        <?php the_title(); ?></h3>
                    <div class="hover_post_blockquote">
                        <p>
                            <?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
                        <p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Watch</a>
                        </p>
                    </div>
                </a>
            </li>

            <?php
    endwhile;
    wp_reset_query();
    ?></ul>
        <div class="row">
            <h3>Articles/Videos</h3>
        </div>
        <ul class="row">
            <?php $additional_loop = new WP_Query("post_type=college-life&cat=58&paged=$paged"); ?>
            <?php while ($additional_loop->
            have_posts()) : $additional_loop->the_post(); ?>
            <?php $attachment_id = get_field('upload_image');
        $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
        $image = wp_get_attachment_image_src( $attachment_id, $size );
        ?>

            <li class="col-xs-12 col-sm-6 col-md-4">
                <a href="<?php the_permalink(); ?>
                    " class="post-link">
                    <div class="post-img">
                        <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></div>
                    <h3 class="post-title">
                        <?php the_title(); ?></h3>
                    <div class="hover_post_blockquote">
                        <p>
                            <?php echo wp_trim_words( get_field( "short_description" ), 40  ); ?></p>
                        <p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Watch</a>
                        </p>
                    </div>
                </a>
            </li>

            <?php endwhile; ?></ul>
        <?php kriesi_pagination($additional_loop->max_num_pages); ?></main>
    <!-- #main -->
</div>
<?php get_footer(); ?>