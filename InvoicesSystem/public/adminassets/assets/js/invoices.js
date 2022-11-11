$(document).ready(function() {
    $('select[name="product_id"]').on('change', function() {
        var SectionId = $(this).val();
        var price = this.options[this.selectedIndex].getAttribute('product_price');
        $('#orginal_price').attr('value', price);
    });
});

function myFunction() {
    var orginal_price = document.getElementById("orginal_price").value;
    var rate_vat = document.getElementById("rate_vat").value;
    var value_vat = (rate_vat / 100) * orginal_price;
    var total = parseFloat(value_vat) + parseFloat(orginal_price);
    document.getElementById("value_vat").value = value_vat
    document.getElementById("total").value = total
}


$("#add_invpice_form").submit(function (e) {
    e.preventDefault();
    var formData = new FormData($('#add_invpice_form')[0]);
    $.ajax({
        type: "POST",
        url: '/invoices/store',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            $('#post_image').attr('src', data.image);
            $('#alert_add_invoice').empty()
            $('#alert_add_invoice').append(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Created Successfuly
                </div>
            `)
            $('.invoicetableadd').prepend('<tr>' +
                '<td>1</td>' +
                '<td>' + data.invoice_number + '</td>' +
                '<td>' + data.orginal_price + '</td>' +
                '<td>' + data.rate_vat + '</td>' +
                '<td>' + data.value_vat + '</td>' +
                '<td>' + data.total + '</td>' +
                '<td>' + data.user + '</td>' +
                '<td></td>' +
                '</tr>')
        },
        error: function (data) {
            console.log(data.message);
            $('#alert_add_invoice').empty()
            for (const key in data.responseJSON.errors) {
                $('#alert_add_invoice').append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '</div>'
                )
            }
        }
    });
});


$('#add_new_discount').submit(function () {
    $("#add_new_discount_button").prop("disabled", true);
    $.ajax({
        type: "POST",
        url: "/admin/courses/discounts/store",
        data: $(this).serialize(),
        success: function (resp) {
            $("#add_new_discount")[0].reset();
            $('.courses_list').show();
            $('.groups_list').hide();
            $('#alert_modal').empty()
            $('#alert_modal').append('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                '<i class="fa fa-exclamation-circle me-2"></i>Successfuly updated' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>')
            $('.discountstableadd').prepend('<tr>' +
                '<td>' + resp.discount_id + '</td>' +
                '<td>' +
                '<a class="titlediscount' + resp.id + '"> ' + resp.title_en + ' </a>' +
                '</td>' +
                '<td>' + resp.course_name + '</td>' +
                '<td>' + resp.percentage + '%</td>' +
                '<td>' + resp.allowed_times + '/' + resp.used_times + '</td>' +
                '<td>' + resp.end_date + '</td>' +
                '<td class="status'+resp.id+'">Active</td>' +
                '<td class="deletestatus'+resp.id+'">' +
                '<div class="button-group">' +
                '<a value="' + resp.id + '" class="deletediscounts btn btn-danger btn-sm"' +
                'href="javascript:void(0)"><i class="fas fa-trash "></i> </a>' +
                '</div>' +
                '</td>' +
                '</tr>')
            $("#add_new_discount_button").prop("disabled", false);
        },
        error: function () {
            $('#alert_modal').empty();
            for (const key in data.responseJSON.errors) {
                $('#alert_modal').append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">\n' +
                    '<i class="fa fa-exclamation-circle me-2"></i>' + data.responseJSON.errors[key][0] + '\n' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\n' +
                    '</div>'
                )
            }
        }
    });
    return false;
});

