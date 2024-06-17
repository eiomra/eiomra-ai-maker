<?php
/*
Plugin Name: Eiomra AI Maker
Description: A Modern plugin that helps web developers to train their AI models and delopy it on sites for users to interact with. You don't need to connect to Chatgpt because it might not be trained with details of what you're working on.
Version: 1.0
Author: Oboyi Thompson Otache
Icon: log.png
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Function to create the table
function create_eiomraai_table() {
    global $wpdb;

    // Database table name
    $table_name = $wpdb->prefix . 'eiomraai';

    // Character set and collation
    $charset_collate = $wpdb->get_charset_collate();

    // SQL statement to create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        message VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        sender VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        date TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Include the upgrade script to use dbDelta
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    // Execute the SQL statement
    dbDelta($sql);

    // Log the SQL execution for debugging
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log("Executed SQL: $sql");
    }
}

// Hook the function to the plugin activation action
register_activation_hook(__FILE__, 'create_eiomraai_table');

// Include other plugin files
include_once(plugin_dir_path(__FILE__) . 'train.php');
include_once(plugin_dir_path(__FILE__) . 'pages/aichat.php');
include_once(plugin_dir_path(__FILE__) . 'pages/messagelog.php');
include_once(plugin_dir_path(__FILE__) . 'hooks/assets.php');
include_once(plugin_dir_path(__FILE__) . 'admin/menu.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/main.php');
include_once(plugin_dir_path(__FILE__) . 'admin/pages/doc.php');
include_once(plugin_dir_path(__FILE__) . 'admin/register.php');  
include_once(plugin_dir_path(__FILE__) . 'admin/models.php');
include_once(plugin_dir_path(__FILE__) . 'hooks/hooks.php');

// Enqueue custom admin styles
function eiomra_ai_admin_styles() {
    echo '<style>
        #adminmenu .toplevel_page_eiomra-ai-settings img {
            width: 20px;
            height: 20px;
            filter: contrast(253%) grayscale(253%); 
        }
    </style>';
}
?>
