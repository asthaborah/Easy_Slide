<div class="wrap">
    
    <!-- Title -->
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form action="options.php" method="post">
        <?php

            //security : nonce
            settings_fields('easy_slider_group');

            //display sections
            do_settings_sections('easy_slider_page1');

            do_settings_sections( 'easy_slider_page2' );

            //submit button
            submit_button('Save Settings');
        ?>

    </form>
</div>