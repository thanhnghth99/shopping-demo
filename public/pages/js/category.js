$(function () {
    // will check later????
    $('input[name="image"]').on('change', function() {
        $('#img-preview').attr('src', '');
        const file = this.files[0];
        const reader = new FileReader();
        reader.onloadend = function() {
            $('#img-preview').attr('src', reader.result);
        };
        if (file) {
            reader.readAsDataURL(file);
        }
    });
})
