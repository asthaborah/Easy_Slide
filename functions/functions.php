<?php
if( ! function_exists( 'easy_slider_get_placeholder_image' )){
    function easy_slider_get_placeholder_image(){
        return "<img src='" . EASY_SLIDER_URL . "assets/images/default.jpg' class='img-fluid wp-post-image' />";
    }
}