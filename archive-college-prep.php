<?php
get_header(); ?> 
<div class="col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0 college-prep content-area">
<main>
    <div class="row">
        <h2 class="col-xs-12 col-md-6"><?php the_title(); ?></h1>
        <div class="col-xs-5 col-xs-offset-0 col-md-4 col-md-offset-1">
            <?php if( get_field( "short_description_college" ) ): ?>                
                <p><?php the_field( "short_description_college" ); ?></p>
            <?php endif;?> 
        </div>
    </div>
  <?php $mypost = array('showposts' => 1, 'post_type' => 'college-prep', 'college-prep_category' => 'about-college-prep');
        $loop = new WP_Query( $mypost ); ?>
    <div class="row top-post"><?php $mypost = array('showposts' => 1, 'post_type' => 'college-prep', 'college-prep_category' => 'top');
        $loop = new WP_Query( $mypost ); ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post();?>
            <?php $attachment_id = get_field('college_image');
            $size = "full"; // (thumbnail, medium, large, full or custom size)
            $image = wp_get_attachment_image_src( $attachment_id, $size );
            ?>
            <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="" class="img-responsive"></a>
            <a href="<?php the_permalink(); ?>"><h3><?php the_title();?></h3></a> 
            <?php the_field('short_description_college'); ?>
        <?php endwhile;  ?>
    </div>

    <div class="row">
    <?php $mypost = array( 'showposts' => 6,'post_type' => 'college-prep', 'college-prep_category' => 'college-prep');
    $loop = new WP_Query( $mypost ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <?php $attachment_id = get_field('college_image');
        $size = "thumbnail"; // (thumbnail, medium, large, full or custom size)
        $image = wp_get_attachment_image_src( $attachment_id, $size );
        ?>
        
       <article class="col-xs-12 col-sm-6 col-md-4" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
           <div class="entry-content">
               <a href="<?php the_permalink(); ?>" class="post-link">
                   <div class="post-img">
                       <img src="<?php echo $image[0]; ?>" alt="" class="img-responsive">
                   </div><h3 class="post-title"><?php the_title( ); ?></h3>
                   <?php the_field( "short_description_college" ); ?>
               </a>
               
           </div><!-- .entry-content -->

       </article><!-- #post-## -->

    <?php endwhile;  ?>
    </div>
</main><!-- #main -->
</div>
<?php get_footer(); ?>
