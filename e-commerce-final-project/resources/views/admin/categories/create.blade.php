@extends('admin.layout.master')

@section('body')
<h1 class="mt-4">Categories</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">All Categories</li>
</ol>
<div class="row">
    <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col- mb-2">
                        <div class="form-group">
                            <label>English Name</label>
                            <input type="text" name="name" class="form-control" placeholder="English Name">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-2">
                    <label for="inputImage">Image</label>
                    <input type="file" name="image" class="form-control" id="inputImage">
                </div>

                <div class="form-group mb-3">
                    <label>Parent</label>
                    <select name="parent_id" class="form-control custom-select">
                        <option value="">-- Select --</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>


                <button class="btn btn-success">Save</button>
            </div>

        </div>
        </form>
</div>
@endsection
