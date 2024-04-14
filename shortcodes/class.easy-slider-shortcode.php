<?php 
if( ! class_exists('Easy_Slider_Shortcode')){
    class Easy_Slider_Shortcode{
        public function __construct(){

            //registered the shortcode
            add_shortcode( 'easy_slider', array( $this, 'add_shortcode' ) );
        }

        public function add_shortcode( $atts = array(), $content = null, $tag = '' ){

            $atts = array_change_key_case( (array) $atts, CASE_LOWER );

            extract( shortcode_atts(

                //default arguments
                array(
                    'id' => '',
                    'orderby' => 'date'
                ),

                //user argument
                $atts,
                $tag
            ));

            //user should pass the slide id seperated by comma
            //Absint function makes your id passed by user is integer
            if( !empty( $id ) ){
                $id = array_map( 'absint', explode( ',', $id ) );
            }

            ob_start();
            require( EASY_SLIDER_PATH . 'views/easy-slider_shortcode.php' );

            //enqueue scripts
            wp_enqueue_script( 'easy-slider-main-jq' );
            wp_enqueue_script( 'easy-slider-options-js' );

            //enqueue styles
            wp_enqueue_style( 'easy-slider-main-css' );
            wp_enqueue_style( 'easy-slider-style-css' );
            return ob_get_clean();
        }
    }
}