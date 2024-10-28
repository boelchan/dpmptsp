$('.summernote').summernote({
    height: "500px",
    toolbar: [
        ['font', ['bold', 'italic', 'underline']],
        // ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        // ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
    ],
    callbacks: {
        onImageUpload: function (image) {
            uploadImage(image[0], $(this));
        },
        // onMediaDelete: function (target) {
        //     deleteImage(target[0].src);
        // }
    }
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function uploadImage(image, target) {
    var data = new FormData();
    data.append("image", image);

    const size = (image.size / 1024 / 1024).toFixed(2);
    if (size > 1) {
        alert("File maksimal berukuran 1Mb");
    } else {
        $.ajax({
            url: "/summernote-upload-image",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function (url) {
                target.summernote("insertImage", url);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
}

function deleteImage(src) {
    $.ajax({
        data: {
            src: src
        },
        type: "POST",
        url: "",
        cache: false,
        success: function (response) {
            console.log(response);
        }
    });
}