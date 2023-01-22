@extends('admin.layout.master')

@section('body')
    <x-heading main="Coupons" secondery="All Coupons"></x-heading>
    <div class="row">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        @if (session('msg'))
                            <div class="alert alert-{{ session('type') }}">
                                {{ session('msg') }}
                            </div>
                        @endif

                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Usage</th>
                                        <th>Expire</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($coupons as $coupon)
                                        <tr id="row_{{ $coupon->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $coupon->name }}</td>
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->usage }}</td>
                                            <td>{{ $coupon->expire }}</td>
                                            <td>
                                                <a onclick="edit_category({{ $coupon->id }})" data-id="{{ $coupon->id }}"
                                                    data-toggle="modal" data-target="#editModal"
                                                    class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i>
                                                </a>

                                                <form class="d-inline"
                                                    action="{{ route('admin.coupons.destroy', $coupon->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('post')
                                                    <button onclick="return confirm('Are you sure?!')"
                                                        class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="edit_form" action="" method="POST">
                        @csrf
                        @method('post')
                        <input type="hidden" name="id" value="">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>English Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="English Name">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Code</label>
                                        <input type="text" name="code" class="form-control" placeholder="Code">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Type</label>
                                        <select name="type" class="form-control custom-select">
                                            <option value="value">Value</option>
                                            <option value="percentage">Percentage</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Value</label>
                                        <input type="text" name="value" class="form-control" placeholder="Value">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Expire</label>
                                        <input type="date" name="expire" class="form-control" placeholder="Expire">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Usage</label>
                                        <input type="number" name="usage" class="form-control" placeholder="Usage">
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Product</label>
                                        <select name="product_id" class="form-control custom-select">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" id="save_edit">Save changes</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script>
        function edit_category(id) {
            let url = '{{ route('admin.coupons.index') }}/' + id;
            $.get({
                url,
                success: (res) => {
                    // console.log('dd');
                    $('#editModal form').attr('action', url)
                    $('#editModal input[name=id]').val(res.id)
                    $('#editModal input[name=name]').val(res.name)
                    $('#editModal input[name=code]').val(res.code)
                    $('#editModal select[name=type]').val(res.type)
                    $('#editModal input[name=value]').val(res.value)
                    $('#editModal input[name=expire]').val(res.expire)
                    $('#editModal input[name=usage]').val(res.usage)
                    $('#editModal select[name=product_id]').val(res.product_id)
                    $('#editModal').modal('show')
                }
            })
        }

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();

            var data = new FormData(this);
            let url = '{{ route('admin.coupons.update') }}';
            $.ajax({
                type: 'post',
                url,
                data,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    $('#row_' + res.id + ' td:nth-child(2)').text(res.name);
                    $('#row_' + res.id + ' td:nth-child(3)').text(res.code);
                    $('#row_' + res.id + ' td:nth-child(4)').text(res.usage);
                    $('#row_' + res.id + ' td:nth-child(5)').text(res.expire);

                    $('#editModal').modal('hide')
                }
            })
        })
    </script>
@endsection
