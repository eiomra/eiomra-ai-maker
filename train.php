<?php
 
// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Function to display the text
function display_eiomra_train() {
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
           <!-- Train Options -->
<div class="container text-center maincontent shadow">
  <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3">
    <div class="col sidebarbgcol"><b>Model Name:</b><br/>
    <input type="text" class="aiboxw" id="modelName" placeholder="Model name" value="eiomra_model" required>
    </div>
    <div class="col sidebarbgcol"><b>Set Epoch:</b><br/>
    <input type="number" class="aiboxw" id="epochs" placeholder="Number of epochs" value="100" required>
    </div>
    <div class="col sidebarbgcol">
    <button id="trainButton" class="aibt2" onclick="trainAndTestModel()">Start Training</button>
    </div>
    <div class="col sidebarbgcol"><button class="aibte" id="downloadButton" onclick="downloadModel()" disabled>Download Model</button></div>
 



    <div class="col sidebarbgcol">
         
    <div class="container text-center dropBox" id="dropBox">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    
  <div class="col addbox"><i class="bi bi-plus-circle-fill"></i>
    <input type="file" id="fileInput" style="display: none;">
</div>
    <div class="col">Upload Text File</div>
    <div class="col">Drag and drop</div>
    

  </div>
</div>
  </div> 

  

  </div>
</div> 



<!-- Question Options -->
<div class="container text-center maincontent shadow">
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">

    <div class="col"><h4>Test Model</h4><br/></div>

    <div class="col"> 
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2">
        
    <div class="col"><input type="text" class="aibox" id="questionInput" placeholder="Enter your question here" required>
    </div>
    <div class="col"><button class="aibt2" id="predictButton" onclick="predictAnswer()">Get Answer</button></div> 
    </div>   </div> 

    <div class="col"> 
  <div id="prediction"></div></div>

  </div>
</div>
 
 
<!-- Log Options -->
<div class="container text-center maincontent shadow">
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1">
    <div class="col"><h4>Training Log</h4></div>
    <div class="col"><div id="logs"></div>  
</div>

           
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

      </body>
    </html>
HTML;
    return $content;
}

// Register the shortcode



// Enqueue the JavaScript file and pass settings


?>
