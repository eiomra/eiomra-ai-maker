let model, encoder, answers;
let qaData;

function log(message) {
  const logs = document.getElementById('logs');
  logs.innerHTML += `${message}<br>`;
}

function handleFileUpload(file) {
  if (file) {
    log("Uploading question-answer data...");
    const reader = new FileReader();
    reader.onload = function(e) {
      qaData = JSON.parse(e.target.result);
      log("Question-answer data uploaded successfully.");
    };
    reader.readAsText(file);
  }
}

function handleFileDrop(event) {
  event.preventDefault();
  const file = event.dataTransfer.files[0];
  handleFileUpload(file);
}

function handleDragOver(event) {
  event.preventDefault();
  document.getElementById('dropBox').classList.add('hover');
}

function handleDragLeave(event) {
  document.getElementById('dropBox').classList.remove('hover');
}

async function loadQAData(qaData) {
  log("Parsing question-answer data...");
  const questions = qaData.map(item => item.question);
  answers = qaData.map(item => item.answer);
  log("Question-answer data parsed successfully.");
  return { questions, answers };
}

async function loadEncoder() {
  log("Loading Universal Sentence Encoder...");
  encoder = await use.load();
  log("Encoder loaded successfully.");
  return encoder;
}

async function preprocessData(encoder, questions) {
  log("Encoding training questions...");
  const encodedQuestions = await encoder.embed(questions);
  log("Questions encoded successfully.");
  return encodedQuestions;
}

async function buildAndTrainModel(questions, answers, epochs) {
  log("Building the model...");
  model = tf.sequential();
  model.add(tf.layers.dense({ units: 256, inputShape: [512], activation: 'relu' }));
  model.add(tf.layers.dense({ units: 256, activation: 'relu' }));
  model.add(tf.layers.dense({ units: answers.length, activation: 'softmax' }));

  model.compile({ optimizer: 'adam', loss: 'sparseCategoricalCrossentropy', metrics: ['accuracy'] });
  log("Model built and compiled successfully.");

  encoder = await loadEncoder();
  const encodedQuestions = await preprocessData(encoder, questions);

  log("Preparing training data...");
  const answerIndices = answers.map((_, idx) => idx);
  const ys = tf.tensor1d(answerIndices, 'float32');
  log("Training data prepared.");

  log("Training the model...");
  await model.fit(encodedQuestions, ys, {
    epochs: epochs,
    callbacks: {
      onEpochEnd: (epoch, logs) => {
        log(`Epoch ${epoch + 1}: Loss = ${logs.loss.toFixed(4)}, Accuracy = ${(logs.acc * 100).toFixed(2)}%`);
      }
    }
  });
  log("Model trained successfully.");

  return model;
}

async function predictAnswer() {
  const questionInput = document.getElementById('questionInput');
  const question = questionInput.value.trim();
  if (!question) {
    log("Please enter a question.");
    return;
  }

  log("Encoding question...");
  const encodedQuestion = await encoder.embed([question]);
  log("Question encoded successfully.");

  log("Making prediction...");
  const prediction = model.predict(encodedQuestion);
  const predictedIndex = prediction.argMax(-1).dataSync()[0];
  const predictedAnswer = answers[predictedIndex];

  const predictionDiv = document.getElementById('prediction');
  predictionDiv.innerHTML = `<b>Question:</b> ${question}<br><b>Predicted Answer:</b> ${predictedAnswer}`;
}

async function trainAndTestModel() {
  try {
    if (!qaData) {
      log("Please upload the QA data file.");
      return;
    }
    const epochs = parseInt(document.getElementById('epochs').value);
    const modelName = document.getElementById('modelName').value;

    const { questions, answers } = await loadQAData(qaData);
    model = await buildAndTrainModel(questions, answers, epochs);
    log("Model training and testing completed.");
    document.getElementById('downloadButton').disabled = false;
  } catch (error) {
    log("An error occurred during the training and testing process: " + error);
  }
}

async function downloadModel() {
  const modelName = document.getElementById('modelName').value;
  log("Saving the model...");
  await model.save(`downloads://${modelName}`);
  log("Model saved successfully.");
}

document.getElementById('questionInput').addEventListener('keyup', function(event) {
  if (event.key === 'Enter') {
    predictAnswer();
  }
});

document.getElementById('dropBox').addEventListener('drop', handleFileDrop);
document.getElementById('dropBox').addEventListener('dragover', handleDragOver);
document.getElementById('dropBox').addEventListener('dragleave', handleDragLeave);

document.getElementById('dropBox').addEventListener('click', () => {
  document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', (event) => {
  const file = event.target.files[0];
  handleFileUpload(file);
});
