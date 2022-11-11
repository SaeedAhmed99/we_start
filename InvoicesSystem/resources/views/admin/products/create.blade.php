@extends('admin.layout.master')

@section('title', 'Create Post | ' . env('APP_NAME'))

@section('content')

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Create Invoice</li>
        </ol>
    </div>
    <div class="px-4 m-2 py-2 .bg-light card">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Add Product</h1>
        <div id="alert_create_product"></div>
        <form id="create_product_form">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" min="1" name="price" value="{{ old('price') }}" placeholder="Price" class="form-control @error('price') is-invalid @enderror">
                @error('price')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" placeholder="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success px-5"><i class="fas fa-plus"></i> Create</button>
        </form>
    </div>
</main>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.2.0/tinymce.min.js" integrity="sha512-tofxIFo8lTkPN/ggZgV89daDZkgh1DunsMYBq41usfs3HbxMRVHWFAjSi/MXrT+Vw5XElng9vAfMmOWdLg0YbA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>
    tinymce.init({
      selector: 'textarea',
      plugins: ['code']
    });
  </script>

<script src="{{asset ('adminassets/assets/js/products.js') }}"></script>

@stop
