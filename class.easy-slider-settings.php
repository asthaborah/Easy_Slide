<?php 

// setting class
if( ! class_exists( 'Easy_Slider_Settings' )){
    class Easy_Slider_Settings{

        public static $options;

        public function __construct(){
            self::$options = get_option( 'easy_slider_options' );

            //settings and field registered
            add_action( 'admin_init', array( $this, 'admin_init') );
        }

        public function admin_init(){
            
            // registered settings
            register_setting( 'easy_slider_group', 'easy_slider_options' );

            // section 1
            add_settings_section(
                'easy_slider_main_section', //id
                'How does it work?', //title
                null,                 //callback function
                'easy_slider_page1'   //page 
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

        //callback function for field 1.1
        public function easy_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode [easy_slider] to display the slider in any page/post/widget</span>
            <?php
        }

    }
}

