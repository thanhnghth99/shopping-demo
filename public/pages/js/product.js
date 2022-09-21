$(function () {
    var editors = document.querySelectorAll('.ckeditor');
    for (var i = 0; i < editors.length; i++) {
        ClassicEditor
        .create(editors[i])
        .catch(error => {
            console.error(error);
        });
    }

    // // will check later????
    // $('input[name="image"]').on('change', function() {
    //     $('#img-preview').attr('src', '');
    //     const file = this.files[0];
    //     const reader = new FileReader();
    //     reader.onloadend = function() {
    //         $('#img-preview').attr('src', reader.result);
    //     };
    //     if (file) {
    //         reader.readAsDataURL(file);
    //     }
    // });

    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            $(".product-imgs").remove();

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="pb-4 product-imgs w-24">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#image').on('change', function() {
        imagesPreview(this, 'div.img-preview');
    });
})
