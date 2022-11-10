@extends('admin.layout.master')

@section('title', 'Logs | ' . env('APP_NAME'))

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
            <li class="breadcrumb-item active">Logs</li>
        </ol>
    </div>

    <div class="px-4 m-2 py-2 .bg-light card">
        <h1 class="h3 mb-4 text-gray-800">Logs</h1>
        <form id="search-form" method="GET" action="{{ route('admin.logs') }}">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search here.." name="search" value="{{ request()->search }}">
                <select name="count" onchange="document.getElementById('search-form').submit()">
                    <option {{ request()->count == 10 ? 'selected' : '' }} value="10">10</option>
                    <option {{ request()->count == 15 ? 'selected' : '' }} value="15">15</option>
                    <option {{ request()->count == 20 ? 'selected' : '' }} value="20">20</option>
                    <option @selected(request()->count == $logs->total()) value="{{ $logs->total() }}">All</option>
                </select>
                <div class="input-group-append">
                <button class="btn btn-dark px-4" id="button-addon2">Button</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-hover table-striped">
            <tr class="text-dark">
                <th>ID</th>
                <th>Type</th>
                <th>Action</th>
                <th>User</th>
                <th>Created At</th>
            </tr>

            @forelse ($logs as $log)

                <tr>
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $log->type }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{{ $log->user->first_name }} {{ $log->user->last_name }}</td>
                    <td>{{ $log->created_at->format('F d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No Data Found</td>
                </tr>
            @endforelse
        </table>

        {{ $logs->appends($_GET)->links() }}
    </div>
</main>
@stop

@section('js')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
@stop
