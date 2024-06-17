<?php

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

function eiomra_message_log_shortcode($atts) {

    function get_eimo_my_table_data()
    {
        global $wpdb;

        $cache_key = 'eimo_my_table_data';
        $cache_expire = 60 * 60;
        $records = wp_cache_get($cache_key);

        if (false === $records) {
            {
                $eiomtable = $wpdb->prefix . 'eiomraai'; 
                $records = $wpdb->get_results( 
                $wpdb->prepare("SELECT * FROM $eiomtable"));
                wp_cache_set($cache_key, $records, 'eimo_my_table_data', $cache_expire);

                }  
        }

        return $records;
    }
 
    $records = get_eimo_my_table_data();

    if ($records) {
        
        echo '<div class="container text-start table-responsive">';
        echo '<table class="table table-hover table-striped">';
        echo '<thead>';
        echo '<tr>';
            echo '<th scope="col">#</th>';
            echo '<th scope="col">Message</th>';
            echo '<th scope="col">Sender</th>';  
            echo '<th scope="col">Date</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
 
        $counter = $offset + 1;
        foreach ($records as $record) { 
            echo '<tr>';
            echo '<td>' . esc_html($counter) . '</td>'; // Use counter instead of id
            echo '<td>' . esc_html($record->message) . '</td>';
            echo '<td>' . esc_html($record->sender) . '</td>';
            echo '<td>' . esc_html($record->date) . '</td>';
            echo '</tr>';
            $counter++;
        } 

        echo '</tbody>';
        echo '</table>';
        echo '</div>'; 
    } else {
        echo '<p>No records found.</p>';
    }
}

// Register shortcode
add_shortcode('eiomra_message_log', 'eiomra_message_log_shortcode'); 
?>
