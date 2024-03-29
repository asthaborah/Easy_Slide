<?php 

//custom post type class
if( !class_exists( 'Easy_Slider_Post_Type') ){
    class Easy_Slider_Post_Type{
        function __construct(){
            add_action( 'init', array( $this, 'create_post_type' ) );
        }

        public function create_post_type(){

        }

    }
}
