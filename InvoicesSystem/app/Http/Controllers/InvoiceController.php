<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function index() {
        $invoices = Invoice::orderByDesc('id')->paginate(10);
        $products = Product::latest()->get();
        return view('admin.invoices.index', compact('invoices', 'products'));
    }

    public function create() {
        return view('admin.invoices.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'product_id' => 'required',
            // 'orginal_price' => 'required',
            // 'rate_vat' => 'required',
            // 'value_vat' => 'required',
            // 'total' => 'required',
        ]);
        // dd($request->all());

        $product = Product::findOrFail($request->product_id);
        $orginal_price = $product->price;
        $value_vat = (number_format($request->rate_vat) / 100) * $orginal_price;
        $total = $value_vat + number_format($request->orginal_price);

        $invoice = Invoice::create([
            'invoice_number' => $this->generate_invoice_number(),
            'orginal_price' => $orginal_price  ,
            'rate_vat' => $request->rate_vat,
            'value_vat' => $value_vat,
            'total' => $total,
            'note' => $request->note,
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'id' => $invoice->id,
            'invoice_number' => $invoice->invoice_number,
            'orginal_price' => $orginal_price,
            'rate_vat' => $invoice->rate_vat,
            'value_vat' => $value_vat,
            'total' => $total,
            'user' =>  $invoice->user->first_name . ' ' . $invoice->user->last_name
        ]);
    }

    function generate_invoice_number() {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
