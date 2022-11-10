@extends('admin.layout.master')

@section('title', 'Trashed Posts | ' . env('APP_NAME'))

@section('css')
<style>
    .table th,
    .table td {
        vertical-align: middle
    }
</style>
@stop

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Trashed Posts</li>
        </ol>
    </div>

    <div class="px-4 m-2 py-2 .bg-light card">
        <h1 class="h3 mb-4 text-gray-800">Trashed Posts</h1>
        <form id="search-form" method="GET" action="{{ route('admin.posts.trash') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search here.." name="search" value="{{ request()->search }}">
                <select name="count" onchange="document.getElementById('search-form').submit()">
                    <option {{ request()->count == 10 ? 'selected' : '' }} value="10">10</option>
                    <option {{ request()->count == 15 ? 'selected' : '' }} value="15">15</option>
                    <option {{ request()->count == 20 ? 'selected' : '' }} value="20">20</option>
                    <option @selected(request()->count == $posts->total()) value="{{ $posts->total() }}">All</option>
                </select>
                <div class="input-group-append">
                <button class="btn btn-dark px-4" id="button-addon2">Button</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-hover table-striped">
            <tr class="text-dark">
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>

            @forelse ($posts as $post)

                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $post->title }}</td>
                    <td><img width="100" src="{{ asset($post->image) }}" alt=""></td>
                    <td>{{ $post->user->first_name }} {{ $post->user->last_name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>{{ $post->updated_at }}</td>
                    <td>
                        {{-- <div class="btn-group"> --}}
                            <a href="{{ route('admin.posts.restore', $post->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-undo"></i></a>
                            <a href="{{ route('admin.posts.forcedelete', $post->id) }}" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a>
                        {{-- </div> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Data Found</td>
                </tr>
            @endforelse
        </table>

        {{-- {{ $posts->appends(['search' => request()->search, 'count' => request()->count])->links() }} --}}
        {{-- {{ $posts->appends($_GET)->links('pagination::tailwind') }} --}}
        {{ $posts->appends($_GET)->links() }}
    </div>
</main>
@stop

@section('js')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@stop
