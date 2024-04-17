<!-- setting page html -->


<!-- creating form and this form will submit the information of our setting page to the database -->


<div class="wrap">

    <!-- Title -->

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <!-- tabs -->
    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
    ?>

    <h2 class="nav-tab-wrapper">
        <a href="?page=easy_slider_admin&tab=main_options" class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Main Options' , 'easy-slider') ?></a>
        <a href="?page=easy_slider_admin&tab=additional_options" class="nav-tab <?php echo $active_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Additional Options' , 'easy-slider') ?></a>
    </h2>

    <!-- form -->
    <form action="options.php" method="post">
        <?php
        if ($active_tab == 'main_options') {
            settings_fields('easy_slider_group');
            do_settings_sections('easy_slider_page1');
        } else {
            settings_fields('easy_slider_group');
            do_settings_sections('easy_slider_page2');
        }
        submit_button(__('Save Settings' , 'easy-slider'));
        ?>
    </form>
</div>