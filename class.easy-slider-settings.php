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
            register_setting( 'easy_slider_group', 'easy_slider_options' , array( $this, 'easy_slider_validate' ) );

            // section 1
            add_settings_section(
                'easy_slider_main_section', //id
                esc_html__('How does it work?' , 'easy-slider'),  //title
                null,                 //callback function
                'easy_slider_page1'   //page 
                
            );

            //section 2
            add_settings_section(
                'easy_slider_second_section',
                esc_html__('Other Plugin Options' , 'easy-slider'),
                null,
                'easy_slider_page2'
            );

            //field 1.1
            add_settings_field(
                'easy_slider_shortcode',
                esc_html__('Shortcode' , 'easy-slider'),
                array( $this, 'easy_slider_shortcode_callback' ),
                'easy_slider_page1',
                'easy_slider_main_section'
            );

            //field 2.1
            add_settings_field(
                'easy_slider_title',
                esc_html__('Slider Title' , 'easy-slider'),
                array( $this, 'easy_slider_title_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section',
                array(
                    'label_for' => 'easy_slider_title'
                )
            );

            //field 2.2
            add_settings_field(
                'easy_slider_bullets',
                esc_html__('Display Bullets' , 'easy-slider'),
                array( $this, 'easy_slider_bullets_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section',
                array(
                    'label_for' => 'easy_slider_bullets'
                )
            );

            //field 2.3
            add_settings_field(
                'easy_slider_style',
                esc_html__('Slider Style' , 'easy-slider'),
                array( $this, 'easy_slider_style_callback' ),
                'easy_slider_page2',
                'easy_slider_second_section',
                array(
                    'items' => array(
                        'style-1',
                        'style-2'
                    ),
                    'label_for' => 'easy_slider_style'
                )
            );
        }

        //callback function for field 1.1 (shortcode)
        public function easy_slider_shortcode_callback(){
            ?>
            <span><?php esc_html_e('Use the shortcode [easy_slider] to display the slider in any page/post/widget' , 'easy-slider')?></span>
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
                <label for="easy_slider_bullets"><?php esc_html_e('Whether to display bullets or not' , 'easy-slider')?></label>
                
            <?php
        }

        //callback function for field 2.3 
        public function easy_slider_style_callback($args){
            ?>
            <select 
                id="easy_slider_style" 
                name="easy_slider_options[easy_slider_style]">
                <?php 
                foreach( $args['items'] as $item ):
                ?>
                    <option value="<?php echo esc_attr( $item ); ?>" 
                        <?php 
                        isset( self::$options['easy_slider_style'] ) ? selected( $item, self::$options['easy_slider_style'], true ) : ''; 
                        ?>
                    >
                        <?php echo esc_html( ucfirst( $item ) ); ?>
                    </option>                
                <?php endforeach; ?>
            </select>
            <?php
        }

        //validating the fields
        public function easy_slider_validate( $input ){
            $new_input = array();
            foreach( $input as $key => $value ){
                switch ($key){
                    case 'easy_slider_title':
                        if( empty( $value )){
                            add_settings_error( 'easy_slider_options', 'easy_slider_message', esc_html__( 'The title field can not be left empty', 'easy-slider' ), 'error' );
                            $value = esc_html__( 'Please, type some text', 'easy-slider' );
                        }
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                    default:
                        $new_input[$key] = sanitize_text_field( $value );
                    break;
                }
            }
            return $new_input;
        }
    }
}

