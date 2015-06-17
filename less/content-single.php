<?php
/**
 * @package Milkoracle
 */
?>
<div class="content-area col-xs-10 col-xs-offset-1 col-md-8 col-md-offset-0">
    <main>
        <article id="post-<?php the_ID(); ?>">
            <header class="entry-header row">
                <h1>

                <?php the_title(); ?></h1>
                <ul class="post-meta clearfix" >
                    <li><div class="author-name"><?php the_author_posts_link() ?></div></li>
                    <li><?php the_time('M d, Y') ?></li>
                </ul>
                <?php if( get_field( "post_view_picture" ) ): ?>                
                    <div class="post_view_picture"><img src="<?php the_field( "post_view_picture" ); ?>" alt=""></div>
                <?php endif;?>  
            </header>
            
                <?php the_content(''); ?>   
            <div class="post-tags row">
                <?php the_tags('', '') ?>
            </div>
                <?php if(function_exists('related_posts')) { related_posts(); } ?>
            
                <?php wp_link_pages( array(
                    'before' =>             
                    '
                    <div class="page-links">
                        ' . __( 'Pages:', 'milkoracle' ),
                    'after'  => '
                    </div>
                    ',
                ) ); ?>
            </div>
        </article>
    </main>
</div><!-- content-area-->
