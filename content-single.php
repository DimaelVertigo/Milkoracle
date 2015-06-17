<?php
/**
 * @package Milkoracle
 */
?>

<div class="content-area content-area-post content-area-include-sidebar col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
    <main>
        <article id="post-<?php the_ID(); ?>">
            <header class="entry-header row">
                <h1><?php the_title(); ?></h1>
                <ul class="post-meta clearfix" >
                    <li><div class="author-name"><?php the_author_posts_link() ?></div></li>
                    <li><?php the_time('M d, Y') ?></li>
                </ul>
               
            </header>
            


            <div class="entry-content row">
                <?php the_content(''); ?>   
                <div class="post-tags row">
                    <?php the_tags('', '') ?>
                </div>
            </div>
              

                <div class="content-block content-block-small row related-video">
                    <h3>RELATED ARTICLES   /   VIDEOS</h3>
                    <ul class="col-xs-12">


                    <?php $project_category = wp_get_post_categories($post->ID); 
                        query_posts('showposts=3&cat=$info'.'$mycat->cat_ID'); ?>  

                        <?php while (have_posts()) : the_post(); ?> 
                        <?php $attachment_id = get_field('upload_image');
                        $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
                        $image = wp_get_attachment_image_src( $attachment_id, $size );
                        ?>      


                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <a href="<?php the_permalink(); ?>
                                " class="post-link">
                                <div class="post-img">
                                    <img src="<?php echo $image[0]; ?>"/></div>
                                <!-- post-img -->               
                               <h3 class="post-title"><?php the_title(); ?></h3>
                            </a>
                        </li>   
                        <?php endwhile; ?>      
                        <?php wp_reset_query(); ?>          
                    </ul>
                </div>

        </article>
    </main>
</div><!-- content-area-->
