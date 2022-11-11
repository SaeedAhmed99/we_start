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
            <li class="breadcrumb-item active">All Invoices</li>
        </ol>
    </div>

    <div class="px-4 m-2 py-2 .bg-light card mb-5">
        <h1 class="h3 mb-4 text-gray-800">Add Invoices</h1>
        <div id="alert_add_invoice"></div>
        <div>
            <form id="add_invpice_form" class="mb-3">
                @csrf
                <div class="row">
                    <div class="col">
                        <label class="mb-2">Select Product</label>
                        <select name="product_id" class="form-control">
                            <option selected>Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" product_price="{{ $product->price }}" >{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label class="mb-2">Original Price</label>
                        <input name="orginal_price" id="orginal_price" value="4" type="text" class="form-control" placeholder="original price" disabled>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label class="mb-2">Rate Vat</label>
                        <input type="text" id="rate_vat" name="rate_vat" onchange="myFunction()" class="form-control" placeholder="rate vat">
                    </div>
                    <div class="col">
                        <label class="mb-2">Value Vat</label>
                        <input type="text" name="value_vat" id="value_vat" value="" class="form-control" placeholder="value vat" disabled>
                    </div>
                    <div class="col">
                        <label class="mb-2">Total</label>
                        <input type="text" id="total" name="total" value="" class="form-control" placeholder="total" disabled>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <label for="exampleFormControlTextarea1">Note</label>
                    <textarea class="form-control" name="note" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

                <button class="btn btn-primary mt-3">Add</button>
            </form>
        </div>
    </div>

    <div class="px-4 m-2 py-2 .bg-light card">
        <h1 class="h3 mb-4 text-gray-800">All Invoices</h1>

        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr class="text-dark">
                    <th>ID</th>
                    <th>Invoice Number</th>
                    <th>Original Price</th>
                    <th>Rate VAT</th>
                    <th>Value VAT</th>
                    <th>Total</th>
                    <th>User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="invoicetableadd">
                @forelse ($invoices as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>{{ $invoice->orginal_price }}</td>
                        <td>{{ $invoice->rate_vat }}</td>
                        <td>{{ $invoice->value_vat }}</td>
                        <td>{{ $invoice->total }}</td>
                        <td>{{ $invoice->user->first_name }} {{ $invoice->user->last_name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No Data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $invoices->appends($_GET)->links() }}
    </div>
</main>
@stop

@section('js')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script>const csrf = "{{ csrf_token() }}";</script>
    <script src="{{asset ('adminassets/assets/js/invoices.js') }}"></script>


@stop
