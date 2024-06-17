<?php
 
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Function to display the text
function eiomra_chat() { 
    $content = <<<HTML
    
    <!doctype html>
    <html lang="en">
      <head> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> 
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/universal-sentence-encoder"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
        .maincontent {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            width: 95%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            margin-bottom: 40px;
            padding: 40px 0px 40px 0px;
        }

        .fixed-bottom {
            background: rgba(255, 255, 255, 0.1);
            margin-left: auto;
            margin-right: auto;
            border-radius: 20px 20px 0px 0px;
            padding: 25px 0px 10px 0px;  
            width: 100%;
        }

        @media (min-width: 992px) {
            .fixed-bottom {
                width: 100%;
                margin-left:auto;
                margin-right:0;  
            }
        }
        </style> 
      </head>
      <body class="body"> 
            <div class="container text-center maincontent shadow min-vh-100">
              <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1"> 
                <div class="col">
                  <div class="container text-start" id="chat"></div>     
                </div> 

              </div> 
            </div>  


          <div class="yte"></div>

          <div class="fixed-bottom shadow position-sticky">
            <div class="container text-center">
              <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
              <input type="hidden" id="eiomra_nonce" name="eiomra_nonce" value="<?php echo wp_create_nonce('eiomra_chat_nonce'); ?>">

                <div class="col">   
                  <div class="input-group mb-3" style="width: 100%;">  
                  <input type="text" class="sep" style="background-color: transparent;
  border-color: transparent;
  border-radius: 10px;
  width: 80%;
  color:#ffffffbe;" id="questionInpute" autofocus 
  placeholder="Ask a question..." aria-describedby="button-addon2">
                    <button class="aibt" style="background-color:transparent;
    border-color:transparent;" type="button" onclick="getAnswer()" id="button-addon2"><i class="bi bi-send-fill"></i></button>
                  </div>
                </div> 

              </div> 
            </div> 
          </div> 
           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

      </body>
    </html>
HTML;
    return $content;
}


// Enqueue and localize script
function eiomra_enqueue_scripts() {
  wp_enqueue_script('eiomra-chat', plugin_dir_url(__FILE__) . '../js/scripts.js', array('jquery'), '1.0', true);
  wp_localize_script('eiomra-chat', 'eiomraAjax', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'nonce' => wp_create_nonce('eiomra_chat_nonce'), // Generate nonce here
  ));
}

 
// AJAX handler for storing messages
function eiomra_save_message() {
  global $wpdb;

  // Verify nonce
  $nonce = isset($_POST['nonce']) ? $_POST['nonce'] : '';
  if ( ! wp_verify_nonce( $nonce, 'eiomra_chat_nonce' ) ) {
      wp_send_json_error('Nonce verification failed');
  }

  if ( ! isset($_POST['message']) || ! isset($_POST['sender']) ) {
      wp_send_json_error('Invalid data');
  }

  $table_name = $wpdb->prefix . 'eiomraai';
  $message = sanitize_text_field($_POST['message']);
  $sender = sanitize_text_field($_POST['sender']);

  $result = $wpdb->insert($table_name, [
      'message' => $message,
      'sender' => $sender,
      'date' => current_time('mysql', 1),
  ]);

  if ($result) {
      wp_send_json_success('Message saved');
  } else {
      wp_send_json_error('Failed to save message');
  }
}
 
?>
