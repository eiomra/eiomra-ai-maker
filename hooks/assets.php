<?php
// Enqueue the CSS file
function chat_styles() {
    if (is_page() && has_shortcode(get_post()->post_content, 'Eiomra_AI')) 
    {    
    wp_enqueue_style('eiomra-chat', plugin_dir_url(__FILE__) . '../css/chat.css', array(), '1.0', 'all');
    }
}

function form_styles() {
    if (is_page() && has_shortcode(get_post()->post_content, ' Eiomra_Train')) 
    {    
    wp_enqueue_style('eiomra-form', plugin_dir_url(__FILE__) . '../css/form.css', array(), '1.0', 'all');
    }
} 


function eiomra_train_shortcode_enqueue_scripts() {
    wp_enqueue_script('eiomra_train-shortcode-scripts', plugin_dir_url(__FILE__) . '../js/train.js', array(), '1.0', true);
  
    // Pass PHP data to JavaScript
    $model_files = get_option('model_files', []);
    $answer_files = get_option('answer_files', []);
    wp_localize_script('eiomra_train-shortcode-scripts', 'eiomraTrainSettings', array(
        'modelFiles' => $model_files,
        'answerFiles' => $answer_files,
    ));
  }



 

?>