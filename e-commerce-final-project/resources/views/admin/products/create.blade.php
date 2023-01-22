@extends('admin.layout.master')

@section('body')
    <x-heading main="Products" secondery="Add New"></x-heading>
    <div class="row">
        <div class="content">
            <div class="row">
                <div class="col-md-12">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-body">

                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="basic-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic" type="button" role="tab" aria-controls="basic"
                                            aria-selected="true">Basic Data</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="images-tab" data-bs-toggle="tab"
                                            data-bs-target="#images" type="button" role="tab" aria-controls="images"
                                            aria-selected="false">Images</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="variations-tab" data-bs-toggle="tab"
                                            data-bs-target="#variations" type="button" role="tab"
                                            aria-controls="variations" aria-selected="false">Variations</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basic" role="tabpanel"
                                        aria-labelledby="basic-tab">
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <div class="form-group">
                                                    <label>English Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="English Name">
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="form-group mt-3">
                                                    <label for="featured" class="mr-3">Featured</label>
                                                    <input id="featured" type="checkbox" name="featured" value="1">
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="form-group">
                                                    <label>English Small Description</label>
                                                    <textarea name="smalldesc" class="form-control contentarea" placeholder="Small Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="form-group">
                                                    <label>English Description</label>
                                                    <textarea name="desc" class="form-control contentarea" placeholder="Description" rows="5"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="number" name="price" class="form-control"
                                                        placeholder="Price">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity" class="form-control"
                                                        placeholder="Quantity">
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category_id" class="form-control custom-select">
                                                        <option value="">-- Select --</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="inputImage">Image</label>
                                                    <input type="file" name="image" class="form-control"
                                                        id="inputImage">
                                                    <img width="120" class="img-thumbnail" src="">
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Gallery</label>
                                                    <div class="dropzone" id="gallery">
                                                        <div class="dz-message">
                                                            Upload Product Images
                                                        </div>
                                                    </div>
                                                    {{-- <input type="file" name="gallery" class="form-control"
                                                        id="inputImage"> --}}

                                                    <div class="gallery-wrapper"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="variations" role="tabpanel"
                                        aria-labelledby="variations-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Colors</label>

                                                    <div class="color-wrapper">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="variation[color][0][value]"
                                                                    class="form-control" placeholder="Value">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" name="variation[color][0][price]"
                                                                    class="form-control" placeholder="price">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-sm btn-primary mt-2 add_feild"
                                                        data-type="color">Add</button>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Sizes</label>
                                                    <div class="size-wrapper">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <input type="text" name="variation[size][0][value]"
                                                                    class="form-control" placeholder="Value">
                                                            </div>
                                                            <div class="col-4">
                                                                <input type="text" name="variation[size][0][price]"
                                                                    class="form-control" placeholder="price">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-sm btn-primary mt-2 add_feild"
                                                        data-type="size">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success mt-3">Save</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <script>
        tinymce.init({
            selector: '.contentarea'
        });

        var uploadedDocumentMap = {}
        Dropzone.autoDiscover = false;
        let myDropzone = new Dropzone("div#gallery", {
            url: "{{ route('admin.products.add.image') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            addRemoveLinks: true,
            success: function(file, response) {
                let image = `<input type="hidden" name="album[]" value="${response}" />`;
                document.querySelector('.gallery-wrapper').insertAdjacentHTML("beforeend", image);
                uploadedDocumentMap[file.name] = response
                // console.log(uploadedDocumentMap);
            },
            removedfile: function(file) {
                file.previewElement.remove()
                name = uploadedDocumentMap[file.name];
                document.querySelector('input[name="album[]"][value="' + name + '"]').remove()
            }
        });

        let btns = document.querySelectorAll('.add_feild');

        btns.forEach(el => {
            el.onclick = (e) => {
                e.preventDefault();
                let type = el.dataset.type;
                // console.log(type);

                let index = document.querySelectorAll(`.${type}-wrapper .row`).length;
                // console.log(index);

                let field = `
            <div class="row">
                <div class="col-8">
                    <input type="text" name="variation[${type}][${index}][value]" class="form-control"
                    placeholder="Value">
                </div>
                <div class="col-4">
                    <input type="text" name="variation[${type}][${index}][price]" class="form-control"
                    placeholder="price">
                </div>
            </div>
            `;


                // document.querySelector(`.${type}-wrapper`).innerHTML += field;
                document.querySelector(`.${type}-wrapper`).insertAdjacentHTML("beforeend", field);


                // $('.btn').click(function() {
                // })
                // $('.btn').on('click', function() {
                // })
                // $('.btn-wrapper').on('click', '.btn', function() {
                // })
            }
        })

        let inputImage = document.querySelector('#inputImage');
        inputImage.onchange = (e) => {
            let output = e.target.nextElementSibling;
            // console.log(output);
            output.src = URL.createObjectURL(e.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        }
    </script>
@endsection
