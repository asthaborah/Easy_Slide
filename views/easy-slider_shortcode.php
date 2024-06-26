<!-- shortcode html file -->

<!-- Slider title -->
<h3><?php echo (!empty($content)) ? esc_html($content) : esc_html(Easy_Slider_Settings::$options['easy_slider_title']); ?></h3>


<!-- setting style of the slider -->
<div class="easy-slider flexslider <?php echo (isset(Easy_Slider_Settings::$options['easy_slider_style'])) ? esc_attr(Easy_Slider_Settings::$options['easy_slider_style']) : 'style-1'; ?>">
    <ul class="slides">
        <?php

        //argument to be passed in wp_query object
        $args = array(
            'post_type' => 'easy-slider',
            'post_status'   => 'publish',
            'post__in'  => $id,
            'orderby' => $orderby
        );

        //creating object of wp_query
        $my_query = new WP_Query($args);


        //loop
        if ($my_query->have_posts()) :
            while ($my_query->have_posts()) : $my_query->the_post();

                //getting button data
                $button_text = get_post_meta(get_the_ID(), 'easy_slider_link_text', true);
                $button_url = get_post_meta(get_the_ID(), 'easy_slider_link_url', true);

        ?>
                <li>
                    <!-- background image -->
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', array('class' => 'img-fluid'));
                    } else {
                        echo easy_slider_get_placeholder_image();
                    } ?>
                    <div class="mvs-container">
                        <div class="slider-details-container">
                            <div class="wrapper">
                                <div class="slider-title">

                                    <!-- Title of the post  -->
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="slider-description">

                                    <!-- Description of the post  -->
                                    <div class="subtitle"><?php the_content(); ?></div>
                                    <a class="link" href="<?php echo esc_attr($button_url); ?>"><?php echo esc_html($button_text); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </ul>
</div>