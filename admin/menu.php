<?php



// Create admin menu
function eiomra_ai_create_menu() {
    add_menu_page(
        'Eiomra AI', 
        'Eiomra AI', 
        'manage_options', 
        'eiomra-ai-settings', 
        'eiomra_ai_main_settings_page', 
        plugin_dir_url(__FILE__) . '../img/eiomramainlogo.png', 
        2
    );
    
    
    add_submenu_page(
        'eiomra-ai-settings', 
        'Model and Answer Files', 
        'Model & Answer Files', 
        'manage_options', 
        'eiomra-ai-model-answer-files', 
        'eiomra_ai_model_answer_files_page'
    );
 
    add_submenu_page(
        'eiomra-ai-settings', 
        'Documentation', 
        'Documentation', 
        'manage_options', 
        'eiomra-ai-settings-documentation', 
        'eiomra_ai_main_settings_documentation'
    );



 
}

?>