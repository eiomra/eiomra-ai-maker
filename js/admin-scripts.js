jQuery(document).ready(function($) {
    $('#add-model-file').click(function() {
        $('#model-files-container').append('<div><input type="text" name="model_files[]" value="" /><button type="button" class="remove-field">Remove</button></div>');
    });

    $('#add-answer-file').click(function() {
        $('#answer-files-container').append('<div><input type="text" name="answer_files[]" value="" /><button type="button" class="remove-field">Remove</button></div>');
    });

    $(document).on('click', '.remove-field', function() {
        $(this).parent().remove();
    });
});
