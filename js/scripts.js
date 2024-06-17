let answerList = [];
let modelCollection = [];
let textEncoder;

// Use localized data from PHP
const modelFilesList = eiomraTrainSettings.modelFiles;
const answerFilesList = eiomraTrainSettings.answerFiles;

async function fetchAnswerList(file) {
  try {
    const response = await fetch(file);
    if (!response.ok) {
      throw new Error('Network response was not ok ' + response.statusText);
    }
    const text = await response.text();
    return text.split('\n').filter(line => line.trim() !== '');
  } catch (error) {
    console.error('Error fetching answers:', error);
    return [];
  }
}

async function loadModelFile(file) {
  try {
    const model = await tf.loadLayersModel(file);
    return model;
  } catch (error) {
    console.error('Error loading model:', error);
    return null;
  }
}

async function initializeApp() {
  try {
    const chatElement = document.getElementById('chat');
    if (!chatElement) return;

    chatElement.innerHTML = '<p>Loading models and answers...</p>';
    textEncoder = await use.load();

    // Load all models and answers
    for (const modelFile of modelFilesList) {
      const model = await loadModelFile(modelFile);
      if (model) {
        modelCollection.push(model);
      }
    }

    for (const answerFile of answerFilesList) {
      const answerSet = await fetchAnswerList(answerFile);
      answerList.push(answerSet);
    }

    chatElement.innerHTML = '';
  } catch (error) {
    console.error('Error initializing:', error);
  }
}

async function fetchAnswer() {
  const questionInputElement = document.getElementById('questionInpute');
  const questionText = questionInputElement.value.trim();

  if (!questionText) {
    alert('Please enter a question');
    return;
  }

  displayMessage(questionText, 'user');
  displayMessage('Generating...', 'ai', 'generating');
  questionInputElement.value = '';

  if (!textEncoder || modelCollection.length === 0) {
    await initializeApp();
  }

  try {
    // Randomly select a model and corresponding answers
    const modelIndex = Math.floor(Math.random() * modelCollection.length);
    const selectedModel = modelCollection[modelIndex];
    const selectedAnswers = answerList[modelIndex];

    const embeddings = await textEncoder.embed([questionText]);
    const answerProbabilities = selectedModel.predict(embeddings);
    const answerIndex = answerProbabilities.argMax(-1).dataSync()[0];
    embeddings.dispose();
    answerProbabilities.dispose();

    const predictedAnswer = selectedAnswers[answerIndex];
    displayAnswer(predictedAnswer);
    saveMessageToDatabase(questionText, 'user');
    saveMessageToDatabase(predictedAnswer, 'bot');
  } catch (error) {
    console.error('Error in processing:', error);
  }
}

function displayMessage(text, sender, id) {
  const chat = document.getElementById('chat');
  const messageElement = document.createElement('div');
  messageElement.className = 'message ' + sender;
  messageElement.id = id || '';
  messageElement.textContent = text;
  chat.appendChild(messageElement);
  chat.scrollTop = chat.scrollHeight;
}

function displayAnswer(answer) {
  const generatingElement = document.getElementById('generating');
  if (generatingElement) {
    generatingElement.remove();
  }
  displayMessage(answer, 'ai');
}



function saveMessageToDatabase(message, sender, nonce) {
  const data = new URLSearchParams();
  data.append('action', 'eiomra_save_message');
  data.append('message', message);
  data.append('sender', sender);
  data.append('nonce', nonce); // Use the passed nonce value
  fetch(eiomraAjax.ajaxurl, {
      method: 'POST',
      body: data,
  })
  .then(response => response.json())
  .then(data => {
  })
  .catch(error => console.error('Error:', error));
}


document.addEventListener('DOMContentLoaded', function() {
  const questionInputElement = document.getElementById('questionInpute');
  if (questionInputElement) {
    questionInputElement.addEventListener('keypress', function(event) {
      if (event.key === 'Enter') {
        fetchAnswer();
      }
    });

    window.onload = async () => {
      await initializeApp();
    };
  }
});
