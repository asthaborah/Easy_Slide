<?php
//cpt class
if (!class_exists('Easy_Slider_Post_Type')) {
    class Easy_Slider_Post_Type
    {
        function __construct()
        {

            // custom post type
            add_action('init', array($this, 'create_post_type'));

            // metabox
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));

            //saving the data of metabox in database
            add_action('save_post', array($this, 'save_post'), 10, 2);

            //adding custom column
            add_filter( 'manage_easy-slider_posts_columns', array( $this, 'easy_slider_cpt_columns' ) );

            //populating cpt data
            add_action( 'manage_easy-slider_posts_custom_column', array( $this, 'easy_slider_custom_columns'), 10, 2 );
            
        }

        public function create_post_type()
        {
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
                    'supports'  => array('title', 'editor', 'thumbnail'),
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

        //callback function for custom cpt column
        public function easy_slider_cpt_columns( $columns ){
            $columns['easy_slider_link_text'] = esc_html__( 'Link Text', 'easy-slider' );
            $columns['easy_slider_link_url'] = esc_html__( 'Link URL', 'easy-slider' );
            return $columns;
        }

        //callback function for populating data
        public function easy_slider_custom_columns( $column, $post_id ){
            switch( $column ){
                case 'easy_slider_link_text':
                    echo esc_html( get_post_meta( $post_id, 'easy_slider_link_text', true ) );
                break;
                case 'easy_slider_link_url':
                    echo esc_url( get_post_meta( $post_id, 'easy_slider_link_url', true ) );
                break;                
            }
        }

        // metabox callback function
        public function add_meta_boxes()
        {
            add_meta_box(
                'easy_slider_meta_box',
                'Link Options',
                array($this, 'add_inner_meta_boxes'),
                'easy-slider',
                'normal',
                'high'
            );
        }

        // metabox html (callback function)
        public function add_inner_meta_boxes($post)
        {
            require_once(EASY_SLIDER_PATH . 'views/easy-slider_metabox.php');
        }

        // callback function to save data into database
        public function save_post($post_id)
        {
            // verifying nonce field
            if (isset($_POST['easy_slider_nonce'])) {
                if (!wp_verify_nonce($_POST['easy_slider_nonce'], 'easy_slider_nonce')) {
                    return;
                }
            }

            //not to save sata in the database when autosave is on
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            //verifying if user is in the current screen of cpt
            if (isset($_POST['post_type']) && $_POST['post_type'] === 'easy-slider') {

                //verifying if user can edit
                if (!current_user_can('edit_page', $post_id)) {
                    return;

                } elseif (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }

            if (isset($_POST['action']) && $_POST['action'] == 'editpost') {

                //created four variables to store old and new data of both the custom fields
                $old_link_text = get_post_meta($post_id, 'easy_slider_link_text', true);
                $new_link_text = $_POST['easy_slider_link_text'];
                $old_link_url = get_post_meta($post_id, 'easy_slider_link_url', true);
                $new_link_url = $_POST['easy_slider_link_url'];

                //updating the data
                if (empty($new_link_text)) {
                    update_post_meta($post_id, 'easy_slider_link_text', 'Add some text');
                } else {
                    update_post_meta($post_id, 'easy_slider_link_text', sanitize_text_field($new_link_text), $old_link_text);
                }

                if (empty($new_link_url)) {
                    update_post_meta($post_id, 'easy_slider_link_url', '#');
                } else {
                    update_post_meta($post_id, 'easy_slider_link_url', sanitize_text_field($new_link_url), $old_link_url);
                }
            }
        }
    }
}
