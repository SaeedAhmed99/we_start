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

function onChange() {
    document.getElementById("add_invoices").style.display = "none";
    document.getElementById("block_add_invoices").style.display = "block";
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
            $('#alert_add_invoice').empty()
            $('#alert_add_invoice').append(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>Created Successfuly
                </div>
            `)
            setTimeout(function(){
                $('#alert_add_invoice').empty()
            }, 5000);
            document.getElementById("add_invoices").style.display = "block";
            document.getElementById("block_add_invoices").style.display = "none";
            $('.invoicetableadd').prepend('<tr>' +
                '<td>1</td>' +
                '<td>' + data.invoice_number + '</td>' +
                '<td>' + data.orginal_price + '</td>' +
                '<td>' + data.rate_vat + '</td>' +
                '<td>' + data.value_vat + '</td>' +
                '<td>' + data.total + '</td>' +
                '<td>' + data.user + '</td>' +
                '<td><button class="btn btn-danger" id="del_invoice" invoice_id="' + data.id +'">delete</button>' +
                '<a class="btn btn-primary" >As PDF</a></td>' +
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


$(document).on('click', '#del_invoice', function (e) {
    e.preventDefault();
    var invoice_id = $(this).attr('invoice_id');
    var delinvoice = $(this).parent().parent();

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
                url: "/invoices/destroy",
                data: {
                    _token: csrf,
                    id: invoice_id
                },
                success: function (data) {
                    delinvoice.remove();
                    Swal.fire(
                        'Deleted!',
                        'Record has been deleted.',
                        'success'
                    )
                },
                error: function (data) {
                    Swal.fire(
                        'Not Deleted!',
                        'error'
                    )
                }
            });

        }
    })
});
