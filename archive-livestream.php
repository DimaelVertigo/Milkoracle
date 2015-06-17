<?php
get_header(); ?>
<div class="content-area livestream col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">    
<main>
    <?php $mypost = array('showposts' => 1, 'post_type' => 'livestream');
    $loop = new WP_Query( $mypost ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <div class="row">
            <h1 class="col-xs-12 col-md-6 p0"><?php the_title(); ?></h1>
            <div class="col-xs-5 col-xs-offset-0 col-md-4 col-md-offset-0">
                <div class="enter-date">
                    <?php the_field('enter_date_ls'); ?>
                </div>
                <div class="enter-name-livestream">
                    <?php the_field('enter_name_livestream'); ?>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="enter-time">
                    <?php the_field('enter_time_ls'); ?>
                </div>
            </div>
        </div>
            
        <div class="stream-frame row">
            <? if (get_field('enter_video_link')): ?>
                <?php the_field('enter_video_link'); ?>
            <? else: ?>
            <div class="offline">
                <p>We are<br> offline now</p>
                <span></span>
                <em>until next Broadcast</em>
            </div>
            <script>
            $(".offline span").countdown("<?php the_field('enter_countdown_date'); ?>", function(event) {
                 $(this).text(
                   event.strftime('%D days %H:%M:%S')
                 );
               });
            </script>
            <? endif; ?>
        </div>
           
        <div class="tab row">
            <h3>broadcast schedule</h3>
            <?php if( have_rows('enter_month') ): ?>
            <ul class="tabs row">
                <?php while( have_rows('enter_month') ): the_row(); 

                // vars
                $number = get_sub_field('number_of_events');
                $name = get_sub_field('name_month');

                ?>
                <li>
                    <span><?php echo $number; ?></span>
                    <?php echo $name; ?>
                </li>
                <?php endwhile; ?>
                <div class="lava"></div>
            </ul>
            <?php endif; ?>

            <?php

            // check if the flexible content field has rows of data
            if( have_rows('enter_events') ):

                // loop through the rows of data
                while ( have_rows('enter_events') ) : the_row();

                    // check current row layout
                    if( get_row_layout() == 'event' ):

                        // check if the nested repeater field has rows of data
                        if( have_rows('month_events') ):

                            echo '<div class="box">';

                            // loop through the rows of data
                            while ( have_rows('month_events') ) : the_row();

                                $date = get_sub_field('enter_date');
                                $name = get_sub_field('enter_name');
                                $text = get_sub_field('enter_text');

                                echo '<div class="box-item col-xs-12 col-sm-6 col-md-4">
                                    <span>'.$date.'</span>
                                    <h4>'.$name.'</h4>
                                    '.$text.'
                                </div>';
                            endwhile;

                            echo '</div>';

                        endif;

                    endif;

                endwhile;

            else :

                // no layouts found

            endif;

            ?>
        </div><!-- /.tab -->
    <?php endwhile;  ?>

</main><!-- #main -->
</div>
<?php get_footer(); ?>
