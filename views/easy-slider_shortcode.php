<!-- shortcode html file -->

<!-- Slider title -->
<h3><?php echo ( ! empty ( $content ) ) ? esc_html( $content ) : esc_html( Easy_Slider_Settings::$options['easy_slider_title'] ); ?></h3>


<div class="easy-slider flexslider ">
    <ul class="slides">
        <li>
            <div class="mvs-container">
                <div class="slider-details-container">
                    <div class="wrapper">
                        <div class="slider-title">
                            <h2>Slider Title</h2>
                        </div>
                        <div class="slider-description">
                            <div class="subtitle">Subtitle</div>
                            <a class="link" href="#">Button text</a>
                        </div>
                    </div>
                </div>              
            </div>
        </li>
    </ul>
</div>