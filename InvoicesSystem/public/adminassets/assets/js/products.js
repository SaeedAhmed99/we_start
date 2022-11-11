$("#create_product_form").submit(function (e) {
    e.preventDefault();
    // var formData = new FormData(this);
    var formData = new FormData($('#create_product_form')[0]);
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: '/products/store',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            window.location.href = "/products/";
        },
        error: function (data) {
            console.log(data.message);
            $('#alert_create_product').empty()
            for (const key in data.responseJSON.errors) {
                $('#alert_create_product').append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '</div>'
                )   
            }
        }
    });
});
