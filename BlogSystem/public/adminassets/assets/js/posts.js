    $(document).on('click', '.delete-post', function (e) {
    e.preventDefault();
    var post_id = $(this).attr('post_id');
    var delpost = $(this).parent().parent();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: "/admin/posts/destroy",
                data: {
                    _token: csrf,
                    id: post_id
                },
                success: function (data) {
                    delpost.remove();
                    Swal.fire(
                        'Deleted!',
                        'Record has been deleted.',
                        'success'
                    )
                },
                error: function (data) {
                    Swal.fire(
                        'Not Deleted!',
                        data.responseJSON.message,
                        'error'
                    )
                }
            });
        }
    })
});

    $(document).on('click', '.forcedelete-post', function (e) {
    e.preventDefault();
    var post_id = $(this).attr('post_id');
    var delpost = $(this).parent().parent();

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'post',
                url: "/admin/posts/forcedelete",
                data: {
                    _token: csrf,
                    id: post_id
                },
                success: function (data) {
                    delpost.remove();
                    Swal.fire(
                        'Deleted!',
                        'Record has been deleted.',
                        'success'
                    )
                },
                error: function (data) {
                    Swal.fire(
                        'Not Deleted!',
                        data.responseJSON.message,
                        'error'
                    )
                }
            });
        }
    })
});


$("#update_post_form").submit(function (e) {
    e.preventDefault();
    // var formData = new FormData(this);
    var formData = new FormData($('#update_post_form')[0]);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: '/admin/posts/update',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#post_image').attr('src', data.image);
            $('#alert_edit_post').empty()
            $('#alert_edit_post').append(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Successfuly updated
                </div>
            `)
            setTimeout(function(){
                $('#alert_edit_post').empty()
            }, 8000);
        },
        error: function (data) {
            console.log(data.message);
            $('#alert_edit_post').empty()
            for (const key in data.responseJSON.errors) {
                $('#alert_edit_post').append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '</div>'
                )
                setTimeout(function(){
                    $('#alert_edit_post').empty()
                }, 5000);
            }
        }
    });
});
