<?php
/*
 * Plugin Name:       Easy Slider
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Slideshow plugin
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Astha Borah
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       Easy_Slider
 * Domain Path:       /languages
 */

// defining ABSPATH for security purpose
if (!defined("ABSPATH")) {
    die (' hehehehehe');
}

//defining class
if( ! class_exists( 'Easy_Slider' ) ){
    class Easy_Slider{
        function __construct(){
            $this->define_constants();
        }

        //defined constants
        public function define_constants(){
            define( 'EASY_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
            define( 'EASY_SLIDER_URL', plugin_dir_url( __FILE__ ) );
            define( 'EASY_SLIDER_VERSION', '1.0.0' );
        }

        //activation 
        public static function activate(){
            update_option( 'rewrite_rules', '' );
        }

        //deactivation 
        public static function deactivate(){
            flush_rewrite_rules();
        }

        //uninstall 
        public static function uninstall(){

        }

    }
}

if( class_exists( 'Easy_Slider' ) ){

    // defined activation , deactivation and uninstall hooks
    register_activation_hook( __FILE__, array( 'Easy_Slider', 'activate' ) );
    register_deactivation_hook( __FILE__, array( 'Easy_Slider', 'deactivate' ) );
    register_uninstall_hook( __FILE__, array( 'Easy_Slider', 'uninstall' ) );

    //created object
    $Easy_slider = new Easy_Slider();

} 

