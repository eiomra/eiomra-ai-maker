<?php


// Model and Answer Files settings page
function eiomra_ai_model_answer_files_page() {
    ?>
    <div class="wrap">
        <h1>Model and Answer Files</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields('eiomra_ai_files_group');
                do_settings_sections('eiomra-ai-model-answer-files');
                submit_button();
            ?>
        </form>
    </div>
    <?php
}



// Callbacks for settings fields
function eiomra_ai_model_files_callback() {
    $model_files = get_option('model_files', []);
    if (!is_array($model_files)) {
        $model_files = [];
    }
    ?>
    <div id="model-files-container">
        <?php foreach ($model_files as $index => $file): ?>
            <div>
                <input type="text" name="model_files[]" value="<?php echo esc_attr($file); ?>" />
                <button type="button" class="remove-field">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-model-file">Add Model File</button>
    <?php
}

function eiomra_ai_answer_files_callback() {
    $answer_files = get_option('answer_files', []);
    if (!is_array($answer_files)) {
        $answer_files = [];
    }
    ?>
    <div id="answer-files-container">
        <?php foreach ($answer_files as $index => $file): ?>
            <div>
                <input type="text" name="answer_files[]" value="<?php echo esc_attr($file); ?>" />
                <button type="button" class="remove-field">Remove</button>
            </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="add-answer-file">Add Answer File</button>
    <?php
}

?>