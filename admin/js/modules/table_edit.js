// version 3

$(function() {
    $('.fileinput').click(function() {
        var $input = $("<input type='file' name='file_to_upload' id='file_to_upload' />")
        var $fileinput = $(this);
        $(this).after($input);
        $input.change(function () {
             var filename = get_filename_from_path($(this).val());
             $fileinput.val(filename);
        });
        $input.hide();

        $('#file_to_upload').click();
    });
});

function get_filename_from_path(text) {
    return text.split('\\').pop().split('/').pop();
}
