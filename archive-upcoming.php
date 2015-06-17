<?php
get_header(); ?>
    
<main>
    <?php $mypost = array('showposts' => 1, 'post_type' => 'upcoming');
    $loop = new WP_Query( $mypost ); ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <h1><?php the_title(); ?></h1>
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
                                    echo '<div class="box-item">
                                            <span>'.$date.'</span>
                                            <h3>'.$name.'</h3>
                                            '.$text.'
                                            <p>'.$place.'</p>
                                        </div>';
                                } else {
                                    echo '<div class="box-item">
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
        </div><!-- /.tab -->
    <?php endwhile;  ?>

</main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
