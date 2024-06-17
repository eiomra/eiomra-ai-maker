<?php

// Register settings
function eiomra_ai_register_settings() {
    register_setting('eiomra_ai_files_group', 'model_files');
    register_setting('eiomra_ai_files_group', 'answer_files');

    add_settings_section('my_text_shortcode_files_section', 'Files Settings', null, 'eiomra-ai-model-answer-files');

    add_settings_field('model_files', 'Model Files', 'eiomra_ai_model_files_callback', 'eiomra-ai-model-answer-files', 'my_text_shortcode_files_section');
    add_settings_field('answer_files', 'Answer Files', 'eiomra_ai_answer_files_callback', 'eiomra-ai-model-answer-files', 'my_text_shortcode_files_section');
 
}

// Register the shortcode
function register_eiomra_chat_shortcode() {
    add_shortcode('Eiomra_AI', 'eiomra_chat');
}


function register_eiomra_train_shortcode() {
    add_shortcode('Eiomra_Train', 'display_eiomra_train');
}

?>