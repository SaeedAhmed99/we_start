@extends('admin.layout.master')

@section('body')
    <x-heading main="Categories" secondery="All Categories"></x-heading>
    <div class="row">
        @if (session('msg'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}
            </div>
        @endif

        <table class="table">
            <thead>
                <tr class="table-dark">
                    <th>#</th>
                    <th>name</th>
                    <th>image</th>
                    <th>Parent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr id="row_{{ $category->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <img width="200" src="{{ asset($category->image->path) }}" alt="">
                        </td>
                        <td>{{ $category->parent->name }}</td>
                        <td>
                            <a class="btn btn-primary" onclick="edit_category({{ $category->id }})" data-id="{{ $category->id }}" data-bs-toggle="modal"
                                data-bs-target="#editModal"><i class="fas fa-edit"></i></a>

                            <a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-danger btm-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="edit_form">
                        @csrf
                        @method('put')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Category Name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputImage">Image</label>
                                <input type="file" name="image" class="form-control" id="inputImage">
                                <img width="60" src="" alt="">
                            </div>

                            <div class="form-group">
                                <label>Parent</label>
                                <select name="parent_id" class="form-control custom-select">
                                    <option value="">-- Select --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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

    </div>
@endsection


@section('js')
    <script>
        function edit_category(id) {
            let url = '{{ route("admin.category.index") }}/'+id;
            $.get({
                url,
                success: (res) => {
                    console.log(res);
                    $('#editModal form').attr('action', url)
                    $('#editModal input[name=name]').val(res.name)
                    $('#editModal img').attr('src', '/'+res.image.path)
                    $('#editModal select').val(res.parent_id)
                }
            })
        }

        $('#edit_form').on('submit', function(e) {
            e.preventDefault();
            var data = new FormData(this);
            let url = $('#editModal form').attr('action');
            $.ajax({
                type: 'post',
                url,
                data,
                cache: false,
                contentType: false,
                processData: false,
                success: (res) => {
                    console.log(res);
                    $('#row_'+res.id+' td:nth-child(2)').text(res.name);
                    $('#row_'+res.id+' td:nth-child(3) img').attr('src', '/'+res.image.path)
                    $('#row_'+res.id+' td:nth-child(4)').text(res.parent.name);
                    $('#editModal').modal('hide')
                }
            })
        })

    </script>
@endsection
