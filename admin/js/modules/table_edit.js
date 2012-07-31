// version 2

$(function() {
    $('.fileinput').click(function() {
        var $input = $("<input type='file' name='file_to_upload' id='file_to_upload' />")
        var $fileinput = $(this);
        $(this).after($input);
        $input.change(function () {
             $fileinput.val($(this).val() );
        });
        $input.hide();

        $('#file_to_upload').click();
    });
});
