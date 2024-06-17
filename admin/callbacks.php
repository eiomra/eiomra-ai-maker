<?php

// Callbacks for settings fields
function my_text_shortcode_field1_callback() {
    $setting = get_option('my_text_shortcode_setting1');
    echo "<input type='text' name='my_text_shortcode_setting1' value='" . esc_attr($setting) . "' />";
}

function my_text_shortcode_field2_callback() {
    $setting = get_option('my_text_shortcode_setting2');
    echo "<input type='text' name='my_text_shortcode_setting2' value='" . esc_attr($setting) . "' />";
}

 

?>