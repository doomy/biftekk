// version 1

$(function() {
    $('.fileinput').click(function() {
        $(this).after(
            $("<input type='file' name='file_to_upload' id='file_to_upload' />")
        ).hide();

        $('#file_to_upload').click();
    });
});
