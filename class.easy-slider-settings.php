<?php 

if( ! class_exists( 'Easy_Slider_Settings' )){
    class Easy_Slider_Settings{

        public static $options;

        public function __construct(){
            self::$options = get_option( 'easy_slider_options' );
            
            //registered setting and field
            add_action( 'admin_init', array( $this, 'admin_init') );
        }

        public function admin_init(){

            //section 1
            add_settings_section(
                'easy_slider_main_section',
                'How does it work?',
                null,
                'easy_slider_page1'
            );

            //field 1.1
            add_settings_field(
                'easy_slider_shortcode',
                'Shortcode',
                array( $this, 'easy_slider_shortcode_callback' ),
                'easy_slider_page1',
                'easy_slider_main_section'
            );
        }

        //field 1.1 callback function
        public function easy_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode [easy_slider] to display the slider in any page/post/widget</span>
            <?php
        }

    }
}

