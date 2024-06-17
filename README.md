# eiomra-ai-maker
=== Eiomra AI Maker: Artificial Intelligence Creator ===
Contributors: Thompson
Tags: chatbot, TensorFlow.js, Universal Sentence Encoder, AI, training, deployment
Requires at least: 4.0
Tested up to: 5.9
Stable tag: 1.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This documentation guides you through implementing a chatbot using TensorFlow.js and Universal Sentence Encoder.

== Overview ==

This project enables you to create a chatbot using TensorFlow.js and Universal Sentence Encoder. Here's what you'll do:
1. Upload a dataset of question-answer pairs.
2. Train a neural network model.
3. Upload your trained model and the answer text file.
4. Interact with the model through a simple chat interface.

== Dataset Format ==

The dataset should consist of question-answer pairs in JSON format.
Example dataset.json
[
    {
        "question": "What is the capital of France?",
        "answer": "Paris"
    },
    {
        "question": "How many states are there in the USA?",
        "answer": "50"
    }
]
== Training ==

Page: Create a WordPress page and paste the shortcode [Eiomra_Train] to create the AI model training interface.
Upload Dataset: Drag and drop your dataset.json file or click to upload.
Set Training Parameters: Enter the number of epochs and the model name.
Start Training: Click "Start Training" to initiate training. View logs for progress.
Download Model: After training, click "Download Model" to save.
Test the Chatbot: Enter questions and click "Get Answer" for responses.
== Testing the Chatbot ==

Enter a question in the chat interface.
Press "Enter" or click "Get Answer".
The chatbot will respond based on the trained model.
== Troubleshooting ==

No Response from Chatbot: Ensure the model is trained and the encoder is loaded.
Dataset Issues: Check format and content.
Training Issues: Review logs for errors.
== Deployment ==

Page: Create a WordPress page and paste [Eiomra_AI] for the chat interface.
Model: Provide the trained model link.
Answer: Paste the link to the answer file in .txt format. Format each answer on a new line.
Save changes.
== Feedback/log ==

Use [eiomra_message_log] shortcode to display user chat and AI responses.

== Styling ==

Customize styles using Elementor, custom CSS, or default site styles.

== Video Tutorials ==

Find video tutorials on YouTube: https://www.youtube.com/@eiomraltd

== Contact ==

Email: tumazfresh@gmail.com
WhatsApp: +2347062249206
Website: www.eiomra.com
