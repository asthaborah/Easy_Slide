<?php 
//cpt class
if( !class_exists( 'Easy_Slider_Post_Type') ){
    class Easy_Slider_Post_Type{
        function __construct(){

            // custom post type
            add_action( 'init', array( $this, 'create_post_type' ) );
            
            // metabox
            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );

            //saving the data of metabox in database
            add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
        }

        public function create_post_type(){
            //registered cpt
            register_post_type(
                'easy-slider',
                array(
                    'label' => 'Slider',
                    'description'   => 'Sliders',
                    'labels' => array(
                        'name'  => 'Sliders',
                        'singular_name' => 'Slider'
                    ),
                    'public'    => true,
                    'supports'  => array( 'title', 'editor', 'thumbnail' ),
                    'hierarchical'  => false,
                    'show_ui'   => true,
                    'show_in_menu'  => true,
                    'menu_position' => 5,
                    'show_in_admin_bar' => true,
                    'show_in_nav_menus' => true,
                    'can_export'    => true,
                    'has_archive'   => false,
                    'exclude_from_search'   => false,
                    'publicly_queryable'    => true,
                    'show_in_rest'  => true,
                    'menu_icon' => 'dashicons-images-alt2'
                )
            );
        }

        // metabox callback function
        public function add_meta_boxes(){
            add_meta_box(
                'easy_slider_meta_box',
                'Link Options',
                array( $this, 'add_inner_meta_boxes' ),
                'easy-slider',
                'normal',
                'high'
            );
        }

        // metabox html (callback function)
        public function add_inner_meta_boxes( $post ){
            require_once( EASY_SLIDER_PATH . 'views/easy-slider_metabox.php' );
        }

        // callback function to save data into database
        public function save_post( $post_id ){
            if( isset( $_POST['action'] ) && $_POST['action'] == 'editpost' ){

                //created four variables to store old and new data of both the custom fields
                $old_link_text = get_post_meta( $post_id, 'easy_slider_link_text', true );
                $new_link_text = $_POST['easy_slider_link_text'];
                $old_link_url = get_post_meta( $post_id, 'easy_slider_link_url', true );
                $new_link_url = $_POST['easy_slider_link_url'];

                //updating the data
                update_post_meta( $post_id, 'easy_slider_link_text', $new_link_text, $old_link_text );
                update_post_meta( $post_id, 'easy_slider_link_url', $new_link_url, $old_link_url );
            }
        }
    }
}
