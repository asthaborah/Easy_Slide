<?php

//default image function
if( ! function_exists( 'easy_slider_get_placeholder_image' )){
    function easy_slider_get_placeholder_image(){
        return "<img src='" . EASY_SLIDER_URL . "assets/images/default.jpg' class='img-fluid wp-post-image' />";
    }
}

//bullets function
if( ! function_exists( 'easy_slider_options' )){
    function easy_slider_options(){
        $show_bullets = isset( Easy_Slider_Settings::$options['easy_slider_bullets'] ) && Easy_Slider_Settings::$options['easy_slider_bullets'] == 1 ? true : false;

        wp_enqueue_script( 'easy-slider-options-js', EASY_SLIDER_URL . 'vendor/flexslider/flexslider.js', array( 'jquery' ), EASY_SLIDER_VERSION, true );
        wp_localize_script( 'easy-slider-options-js', 'SLIDER_OPTIONS', array(
            'controlNav' => $show_bullets
        ) );
    }
}