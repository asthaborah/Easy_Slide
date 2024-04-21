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

            $this->load_textdomain();

            //function file
            require_once( EASY_SLIDER_PATH . 'functions/functions.php' );

            //custom menu
            add_action( 'admin_menu', array( $this, 'add_menu' ) );

            require_once( EASY_SLIDER_PATH . 'post-types/class.Easy-slider-cpt.php' );
            //cpt object 
            $Easy_Slider_Post_Type = new Easy_Slider_Post_Type();

            //settings object
            require_once( EASY_SLIDER_PATH . 'class.easy-slider-settings.php' );
            $Easy_Slider_Settings = new Easy_Slider_Settings();

            //shortcode object
            require_once( EASY_SLIDER_PATH . 'shortcodes/class.easy-slider-shortcode.php' );
            $Easy_Slider_Shortcode = new Easy_Slider_Shortcode();

            //enqueing frontend scripts
            add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ), 999 );

            //enqueing admin scripts
            add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts') );
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
            //unregistered cpt
            unregister_post_type( 'easy-slider' );
        }

        //uninstall 
        public static function uninstall(){

        }

        //adding localization support
        public function load_textdomain(){
            load_plugin_textdomain(
                'easy-slider',
                false,
                dirname( plugin_basename( __FILE__ ) ) . '/languages/'
            );
        }

        //callback function of custom menu
        public function add_menu(){
            add_menu_page(
                esc_html__('Easy Slider Options' , 'easy-slider'), // page title
                'Easy Slider', //menu title
                'manage_options', //capability
                'easy_slider_admin', //slug
                array( $this, 'easy_slider_settings_page' ), //callback function
                'dashicons-images-alt2' //icon
            );


            //submenu 1
            add_submenu_page(
                'easy_slider_admin',
                esc_html__('Manage Slides' , 'easy-slider'),
                esc_html__('Manage Slides' , 'easy-slider'),
                'manage_options',
                'edit.php?post_type=easy-slider',
                null,
                null
            );

            //submenu 2
            add_submenu_page(
                'easy_slider_admin',
                esc_html__('Add New Slide' , 'easy-slider'),
                esc_html__('Add New Slide' , 'easy-slider'),
                'manage_options',
                'post-new.php?post_type=easy-slider',
                null,
                null
            );
        }

        //callback function
        public function easy_slider_settings_page(){
            
            //control access to our setting page
            if( ! current_user_can( 'manage_options' ) ){
                return;
            }

            //showing success notification when the data is saved
            if( isset( $_GET['settings-updated'] ) ){
                add_settings_error( 'easy_slider_options', 'easy_slider_message', esc_html__('Settings Saved' , 'easy-slider'), 'success' );
            }
        
            //showing error message
            settings_errors( 'easy_slider_options' );

            //required settings file
            require( EASY_SLIDER_PATH . 'views/settings-page.php' );
        }

        //enqueing scripts and styles
        public function register_scripts(){
            wp_register_script( 'easy-slider-main-jq', EASY_SLIDER_URL . 'vendor/flexslider/jquery.flexslider-min.js', array( 'jquery' ), EASY_SLIDER_VERSION, true );
            wp_register_style( 'easy-slider-main-css', EASY_SLIDER_URL . 'vendor/flexslider/flexslider.css', array(), EASY_SLIDER_VERSION, 'all' );
            wp_register_style( 'easy-slider-style-css', EASY_SLIDER_URL . 'assets/css/frontend.css', array(), EASY_SLIDER_VERSION, 'all' );
        }

        //enqueing admin scripts and styles
        public function register_admin_scripts(){
            global $typenow;
            if( $typenow == 'easy-slider'){
                wp_enqueue_style( 'easy-slider-admin', EASY_SLIDER_URL . 'assets/css/admin.css' );
            }
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

