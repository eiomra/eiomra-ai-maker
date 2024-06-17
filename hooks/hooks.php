<?php 
// Hook into WordPress
add_action('init', 'register_eiomra_train_shortcode');  
add_action('init', 'register_eiomra_chat_shortcode');
add_action('wp_enqueue_scripts', 'chat_styles');
add_action('wp_enqueue_scripts', 'form_styles');
// add_action('wp_enqueue_scripts', 'style_styles'); 
add_action('wp_enqueue_scripts', 'eiomra_train_shortcode_enqueue_scripts'); 
add_action('admin_menu', 'eiomra_ai_create_menu');
add_action('admin_init', 'eiomra_ai_register_settings');  
add_action('admin_head', 'eiomra_ai_admin_styles');   
add_action('wp_enqueue_scripts', 'eiomra_enqueue_scripts'); 
add_action('wp_ajax_eiomra_save_message', 'eiomra_save_message');
add_action('wp_ajax_nopriv_eiomra_save_message', 'eiomra_save_message');  
add_shortcode('eiomra_chat', 'eiomra_chat');
add_shortcode('eiomra_message_log', 'eiomra_message_log_shortcode');

?>