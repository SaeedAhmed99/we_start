@extends('admin.layout.master')

@section('title', 'Edit Post | ' . env('APP_NAME'))

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Edit Post</li>
        </ol>
    </div>
    <div class="px-4 m-2 py-2 .bg-light card">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Edit Post</h1>
        <form action="{{ route('admin.posts.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="hidden" name="id" value="{{ $post->id }}">
                <input type="text" name="title" value="{{ old('title', $post->title) }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
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
                <label>Content</label>
                <textarea name="content" placeholder="Cotnent" class="form-control @error('title') is-invalid @enderror" rows="5">{{ old('content', $post->content) }}</textarea>
                @error('title')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success px-5">Updae</button>
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
@stop
