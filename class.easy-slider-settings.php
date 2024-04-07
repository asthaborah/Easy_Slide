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
                'How does it work?',  //title
                null,                 //callback function
                'easy_slider_page1'   //page 
                
            );

            //section 2
            add_settings_section(
                'easy_slider_second_section',
                'Other Plugin Options',
                null,
                'easy_slider_page2'
            );

            //field 1.1
            add_settings_field(
                'easy_slider_shortcode',
                'Shortcode',
                array( $this, 'easy_slider_shortcode_callback' ),
                'easy_slider_page1',
                'easy_slider_main_section'
            );

            //field 2.1
            add_settings_field(
                'easy_slider_title',
                'Slider Title',
                array( $this, 'easy_slider_title_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section'
            );

            //field 2.2
            add_settings_field(
                'easy_slider_bullets',
                'Display Bullets',
                array( $this, 'easy_slider_bullets_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section'
            );

            //field 2.3
            add_settings_field(
                'easy_slider_style',
                'Slider Style',
                array( $this, 'easy_slider_style_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section'
            );
        }

        //callback function for field 1.1 (shortcode)
        public function easy_slider_shortcode_callback(){
            ?>
            <span>Use the shortcode [easy_slider] to display the slider in any page/post/widget</span>
            <?php
        }

        //callback function for field 2.1 (site Title)
        public function easy_slider_title_callback(){
            ?>
                <input 
                type="text" 
                name="easy_slider_options[easy_slider_title]" 
                id="easy_slider_title"
                value="<?php echo isset( self::$options['easy_slider_title'] ) ? esc_attr( self::$options['easy_slider_title'] ) : ''; ?>"
                >
            <?php
        }
        
        //callback function for field 2.2 (checkbox)
        public function easy_slider_bullets_callback(){
            ?>
                <input 
                    type="checkbox"
                    name="easy_slider_options[easy_slider_bullets]"
                    id="easy_slider_bullets"
                    value="1"
                    <?php 
                        if( isset( self::$options['easy_slider_bullets'] ) ){
                            checked( "1", self::$options['easy_slider_bullets'], true );
                        }    
                    ?>
                />
                <label for="easy_slider_bullets">Whether to display bullets or not</label>
                
            <?php
        }

        //callback function for field 2.3 
        public function easy_slider_style_callback(){
            ?>
            <select 
                id="easy_slider_style" 
                name="easy_slider_options[easy_slider_style]">
                <option value="style-1" 
                    <?php isset( self::$options['easy_slider_style'] ) ? selected( 'style-1', self::$options['easy_slider_style'], true ) : ''; ?>>Style-1</option>
                <option value="style-2" 
                    <?php isset( self::$options['easy_slider_style'] ) ? selected( 'style-2', self::$options['easy_slider_style'], true ) : ''; ?>>Style-2</option>
            </select>
            <?php
        }


    }
}

