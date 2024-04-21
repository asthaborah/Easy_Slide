<!-- Metabox html -->
<?php
$meta = get_post_meta($post->ID);
$link_text = get_post_meta($post->ID, 'easy_slider_link_text', true);
$link_url = get_post_meta($post->ID, 'easy_slider_link_url', true);
?>

<table class="form-table easy-slider-metabox">
    <!-- nonce created -->
    <input type="hidden" name="easy_slider_nonce" value="<?php echo wp_create_nonce("easy_slider_nonce"); ?>">
    <tr>
        <th>
            <label for="easy_slider_link_text"><?php esc_html_e('Link Text' , 'easy-slider') ?></label>
        </th>
        <td>
            <input type="text" name="easy_slider_link_text" id="easy_slider_link_text" class="regular-text link-text" value="<?php echo (isset($link_text)) ? esc_html($link_text) : ''; ?>" required>
        </td>
    </tr>
    <tr>
        <th>
            <label for="easy_slider_link_url"><?php esc_html_e('Link URL' , 'easy-slider') ?></label>
        </th>
        <td>
            <input type="url" name="easy_slider_link_url" id="easy_slider_link_url" class="regular-text link-url" value="<?php echo (isset($link_url)) ? esc_url($link_url) : ''; ?>" required>
        </td>
    </tr>
</table>