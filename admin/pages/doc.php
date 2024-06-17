<?php
function eiomra_ai_main_settings_documentation() {
    ?>
    <h1>Documentation for Implementing the AI</h1>

This documentation will guide you through the steps to implement the chatbot using <br/>
TensorFlow.js and Universal Sentence Encoder. The implementation involves uploading a dataset of <br/>
question-answer pairs, training a model, and deploying a simple chat interface to interact with the trained model.


<h1>Overview</h1>
This project allows you to create the chatbot using TensorFlow.js and Universal Sentence Encoder. You will:<br/>
<b>1. </b>Upload a dataset of question-answer pairs.<br/>
<b>2. </b>Train a neural network model.<br/>
<b>3. </b>Upload your trained model and the answer text file and paste the links<br/>
<b>4. </b>Interact with the model through a simple chat interface.

 
<h1>Dataset Format</h1>
The dataset should consist of question-answer pairs in json format. <br/>
save file with any name, e.g dataset.json<br/>

<h1>Example:</h1>
[<br/>
      {<br/>
        "question": "What is the capital of France?",<br/>
        "answer": "Paris"<br/>
      },<br/>
      {<br/>
        "question": "How many states are there in the USA?",<br/>
        "answer": "50"<br/>
      },<br/>
      {<br/>
        "question": "Who wrote "To Kill a Mockingbird?",<br/>
        "answer": "Harper Lee"<br/>
      },<br/>
      {<br/>
        "question": "What is the boiling point of water?",<br/>
        "answer": "100 degrees Celsius"<br/>
      },<br/>
      {<br/>
        "question": "hi",<br/>
        "answer": "Hey! Glad to have you here. Feel free to ask me anything you'd like to know."<br/>
      },<br/>
      {<br/>
        "question": "thank you",<br/>
        "answer": "You're welcome! If you have any more questions, feel free to ask."<br/>
      }<br/>
   
      ]<br/>


<h1>Training</h1>
<b>1. Page:</b> Create a wordpress page and paste this shortcode [Eiomra_Train]. It will create the AI model training interface.
<br/>
<b>2. Upload Dataset:</b> Drag and drop your `dataset.json` file into the designated area in the browser or click to upload.
<br/>
<b>3. Set Training Parameters:</b> Enter the number of epochs for training and the model name.
<br/>
<b>4. Start Training:</b> Click the "Start Training" button. The logs will display the training progress.
<br/>
<b>5. Download Model:</b> Once training is complete, click "Download Model" to save the trained model.
<br/>
<b>6. Test the Chatbot:</b> Enter questions in the input field and click "Get Answer" to get answers from the trained model.

<h1>Testing the Chatbot</h1>
<b>1.</b> Enter a question in the input field at the bottom of the chat interface.<br/>
<b>2. </b>Press "Enter" or click the "Get Answer" button.<br/>
<b>3. </b>The chatbot will respond with the predicted answer based on the trained model.

<h1>Troubleshooting</h1>
<b>- No Response from Chatbot: </b>Ensure the model is trained and the encoder is loaded before asking questions.<br/>
<b>- Dataset Issues: </b>Make sure the dataset file is correctly formatted with questions and answers separated by tabs.<br/>
<b>- Training Issues: </b>Check the logs for any errors during the training process.

<h1>Delopying</h1>
<b>1. Page:</b> Create a wordpress page and paste this shortcode [Eiomra_AI]. It will create the AI chat interface.
<br/>
<b>1. Model:</b> Goto the Model & Answer Files option at the admin page, and pages the link to the trained ai mode 
link<br/>
The trained .json and .weights.bin should be in same folder/directory
<br/>
<b>1. Answer:</b> Paste the link to the answer file in .txt format in the answer box. 
<br/>
The answer.txt should be in this format
<h1>Answer.txt Format</h1>
Paris<br/>
50<br/>
Harper Lee<br/>
100 degrees Celsius<br/>
Hey! Glad to have you here. Feel free to ask me anything you'd like to know.<br/>
You're welcome! If you have any more questions, feel free to ask.<br/><br/>
Each answer should be in the next line for easy mapping and accuracy.
<br/>
Then Save changes.<br/><br/>
<b>Feedback/log:</b> Create a wordpress page and use this shortcode [eiomra_message_log] it will show all the users chat and AI responses</b> 
This will help you to know what data to add to your model.
<br/><br/> 
<h1>Styling</h1>
You can set your preferred background color, button color, text color et'c using elementor, custom css or the plugin 
will your default site styles<br/>
<h1>Video Tutorials</h1> 
<b><a href="https://www.youtube.com/@eiomraltd">Youtube</a></b><br/>

<h1>Contact</h1>
You can contact us on<br/> 
<b>Email:</b>tumazfresh@gmail.com<br/>
<b>Whatsapp</b>+2347062249206<br/>

<h1>Website</h1> 
<b><a href="https://www.eiomra.com">Eiomra</a></b><br/>


<br/><br/><br/>




    <?php
}

?>