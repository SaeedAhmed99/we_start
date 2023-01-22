@extends('admin.layout.master')

@section('body')
    <x-heading main="Products" secondery="All Products"></x-heading>
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
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($products as $product)
                                        {{-- @dump($product->image) --}}
                                        <tr id="row_{{ $product->id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td><img width="70" src="{{ asset($product->image->path ?? '') }}"
                                                    alt="">
                                            </td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->created_at->format('F m, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                    class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i></a>
                                                <form class="d-inline"
                                                    action="{{ route('admin.products.destroy', $product->id) }}"
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
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
