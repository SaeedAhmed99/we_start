@extends('admin.layout.master')

@section('title', 'All Invoices | ' . env('APP_NAME'))

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
            <li class="breadcrumb-item active">All Products</li>
        </ol>
    </div>

    <div class="px-4 m-2 py-2 .bg-light card">
        <h1 class="h3 mb-4 text-gray-800">All Products</h1>

        <table class="table table-bordered table-hover table-striped">
            <tr class="text-dark">
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Created By</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>

            @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->title }}</td>
                    <td><img width="100" height="100" src="{{ asset($product->image) }}" alt=""></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->user->first_name }} {{ $product->user->last_name }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>action</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Data Found</td>
                </tr>
            @endforelse
        </table>

        {{ $products->appends($_GET)->links() }}
    </div>
</main>
@stop

@section('js')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script>const csrf = "{{ csrf_token() }}";</script>
    <script src="{{asset ('adminassets/assets/js/posts.js') }}"></script>
@stop
