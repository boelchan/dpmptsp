$('body').on('click', '.delete-user, .delete-data', function () {
    Swal.fire({
        title: 'Hapus ' + $(this).data("label") + '?',
        text: "Data yang telah dihapus tidak dapat dikembalikan",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "DELETE",
                url: $(this).data("url"),
                data: { "_token": $(this).data('token') },
                success: function (data) {
                    Swal.fire({
                        title: 'Sukses',
                        text: 'Data berhasil dihapus',
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then((result) => {
                        if (data.redirect) {
                            location.href = data.redirect;
                        } else {
                            location.reload()
                        }
                    })
                },
                error: function (e) {
                    if (e.responseJSON.message) {
                        var swal_message = e.responseJSON.message;
                    } else {
                        var swal_message = "Data gagal dihapus";
                    }
                    Swal.fire({
                        title: 'Gagal menghapus data',
                        text: swal_message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        }
    })
});

// delete
$('body').on('click', '.block-user', function () {
    var label = 'data ?';
    if ($(this).data("label")) {
        label = $(this).data("label");
    }
    var target = $(this).data("target");

    Swal.fire({
        title: label,
        // text: "Data yang telah hapus tidak dapat dikembalikan",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: $(this).data("url"),
                data: { "_token": $(this).data('token') },
                success: function (data) {
                    Swal.fire({
                        title: 'Sukses',
                        text: data.message,
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then((result) => {
                        location.href = data.redirect;
                    })
                },
                error: function (e) {
                    if (e.responseJSON.message) {
                        var swal_message = e.responseJSON.message;
                    } else {
                        var swal_message = "Silahkan coba kembali";
                    }
                    Swal.fire({
                        title: 'Gagal',
                        text: swal_message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        }
    })
});


$('body').on('change', '#icon', function () {
    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    if (size > 1) {
        alert("File maksimal berukuran 1Mb");
        $(this).val('');
        $('#icon').attr('src', '/static/sampel.jpg');
    }
});
$('body').on('change', '#gambar', function () {
    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    if (size > 1) {
        alert("File maksimal berukuran 1Mb");
        $(this).val('');
        $('#output').attr('src', '/static/sampel.jpg');
    }
});
$('body').on('change', '#gambar200', function () {
    const size = (this.files[0].size / 1024 / 1024).toFixed(2);
    if (size > 0.2) {
        alert("File maksimal berukuran 200kb");
        $(this).val('');
        $('#output').attr('src', '/static/sampel.jpg');
    }
});

// form action di buttin
$('body').on('click', '.form-action', function () {
    var label = 'data ?';
    if ($(this).data("label")) {
        label = $(this).data("label");
    }

    Swal.fire({
        title: label,
        text: "Apakah Anda sudah Yakin ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: $(this).data("url"),
                data: { "_token": $(this).data('token') },
                success: function (data) {
                    Swal.fire({
                        title: 'Sukses',
                        text: data.message,
                        icon: 'success',
                        timer: 1000,
                        showConfirmButton: false,
                    }).then((result) => {
                        if (data.redirect) {
                            location.href = data.redirect;
                        } else {
                            location.reload();
                        }
                    })
                },
                error: function (e) {
                    if (e.responseJSON.message) {
                        var swal_message = e.responseJSON.message;
                    } else {
                        var swal_message = "Silahkan coba kembali";
                    }
                    Swal.fire({
                        title: 'Gagal',
                        text: swal_message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        }
    })
});

$('#form-x').submit(function (e) {
    e.preventDefault();
    Swal.fire({
        title: "Apakah Anda sudah Yakin ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function (data) {
                    $(this).find('input, select, textarea').val('')
                    Swal.fire({
                        title: 'Sukses',
                        text: data.message,
                        icon: 'success',
                        timer: 2000,
                        showConfirmButton: false,
                    }).then((result) => {
                        if (data.redirect) {
                            location.href = data.redirect;
                        } else {
                            location.reload();
                        }
                    })
                },
                error: function (e) {
                    if (e.responseJSON.message) {
                        var swal_message = e.responseJSON.message;
                    } else {
                        var swal_message = "Silahkan coba kembali";
                    }
                    Swal.fire({
                        title: 'Gagal',
                        text: swal_message,
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            });
        }
    })
});