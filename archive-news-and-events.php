<?php
get_header(); ?>
<div class="content-area livestream news col-xs-10 col-xs-offset-1 col-sm-12 col-sm-offset-0">
<main>
    <?php $mypost = array('showposts' => 1, 'post_type' => 'news-and-events');
    $loop = new WP_Query( $mypost ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <h1 class="p0 row"><?php the_title(); ?></h1>
        <?php the_content(); ?>
        <div class="tab row">
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
                                $place = get_sub_field('enter_place');
                                $live = get_sub_field('live_stream');
                                if ($place) {
                                    echo '<div class="box-item col-xs-12 col-sm-6 col-md-4">
                                            <span>'.$date.'</span>
                                            <h3>'.$name.'</h3>
                                            '.$text.'
                                            <p class="place">'.$place.'</p>
                                        </div>';
                                } else {
                                    echo '<div class="box-item col-xs-12 col-sm-6 col-md-4">
                                            <span>'.$date.' <em>Livestream</em></span>
                                            <h3>'.$name.'</h3>
                                            '.$text.'
                                            <a href="#" class="name">'.$live.'</a>
                                        </div>';
                                } 
                        
                            endwhile;
                               
                            echo '</div>';

                        endif;

                    endif;

                endwhile;

            else :

                // no layouts found

            endif;

            ?>
            <div class="clear"></div>
            <div class="question-form col-xs-12 col-sm-6 col-md-4">
                <?php echo do_shortcode('[contact-form-7 id="525" title="ask your questions"]' ) ?>
            </div>
        </div><!-- /.tab -->
    <?php endwhile;  ?>

</main><!-- #main -->
</div>
<?php get_footer(); ?>
