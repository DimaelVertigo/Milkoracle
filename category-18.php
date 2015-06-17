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
    <div class="col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0 page-question content-area">
        <div class="row"><h1>QUESTION LIST</h1></div>
        <article id="post-<?php the_ID(); ?>">

            <div class="entry-content row">
                <?php $additional_loop = new WP_Query("cat=18&paged=$paged"); ?>   
                <?php while ($additional_loop->have_posts()) : $additional_loop->the_post(); ?>
                <span class="question"><?php the_field( "enter_question" ); ?></span>
                <?php if( get_field( "enter_answer" ) ): ?>               
                    <p class="enter_answer"><?php the_field( "enter_answer" ); ?></p>
                <?php endif;?>  
                <?php the_content(); ?> 
                <div class="post-tags row">
                    <?php the_tags('', '') ?>
                </div>
                <?php endwhile; ?>              
                <?php wp_reset_query(); ?>
            </div>
            <?php kriesi_pagination($additional_loop->max_num_pages); ?>

        </article>
    </div><!-- content-area -->
</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
