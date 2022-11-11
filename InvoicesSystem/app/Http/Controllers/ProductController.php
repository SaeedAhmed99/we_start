<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index() {
        $products = Product::orderByDesc('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:10|max:250',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'description' => 'nullable|min:10',
            'price' => 'required',
        ]);

        $image = null;
        $path = null;
        if ($request->hasFile('image')) {
            $image = "product-" . time() . "." . $request->image->getClientOriginalExtension();
            $path = $request->image->move(public_path('images/product'), $image);
            $path = 'images/product/' . $image;
        }

        $title = $this->removescript($request->title);
        Product::create([
            'title' => $title,
            'image' => $path,
            'description' => $request->content,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);
        // $this->logs('create', 'create post (' . substr($title, 0, 10) . ' ...) by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return true;
    }

    private function removescript($input) {
        $input = str_replace('<script>', '', $input);
        return str_replace('</script>', '', $input);
    }
}
