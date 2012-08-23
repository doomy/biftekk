// version 4

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

    $('#add_new_button').click(function(){
       $('#newline').show();
       $(this).hide();
       var $hidden = $("<input type='hidden' name='new_row' value='yes' />");
       $(this).after($hidden);
    });
});

function get_filename_from_path(text) {
    return text.split('\\').pop().split('/').pop();
}
