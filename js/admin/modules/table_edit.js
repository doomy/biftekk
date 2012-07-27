// version 1

$(function() {
    $('.fileinput').click(function() {
        $(this).after(
            $("<input class='hidden' type='file' name='file_to_upload' id='file_to_upload' />")
        );
        $('#file_to_upload').click();
    });
});
