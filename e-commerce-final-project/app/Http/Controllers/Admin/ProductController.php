<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.products.create', compact('categories'));
    }

    public function add_image(Request $request)
    {
        $image_name = $request->file('file')->store('uploads/products', 'custom');
        return $image_name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $slug = Str::slug($request->en_name);
        $count = Product::whereSlug($slug)->count();
        if ($count > 0) {
            $slug = $slug . '-' . $count;
        }

        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => $request->name,
                'slug' => $slug,
                'smalldesc' => $request->smalldesc,
                'desc' => $request->desc,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'featured' => $request->input('featured', 0)
            ]);

            if ($request->hasFile('image')) {
                $image = $request->file('image')->store('uploads/products', 'custom');
                $product->gallery()->create([
                    'path' => $image,
                    'feature' => 1
                ]);
            }

            if ($request->has('album')) {
                foreach ($request->album as $file) {
                    $product->gallery()->create([
                        'path' => $file,
                        'feature' => 0
                    ]);
                }
            }

            if ($request->has('variation')) {
                foreach ($request->variation as $type => $data) {
                    foreach ($data as $info) {
                        $product->variations()->create([
                            'type' => $type,
                            'value' => $info['value'],
                            'extraprice' => $info['price']
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.products.index')->with('msg', 'Product created successfullly')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::select(['id', 'name'])->get();
        $product = $product->load('image', 'category', 'gallery', 'variations');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            $product->image->delete();
        }
        if ($product->gallery) {
            foreach ($product->gallery as $image) {
                $image->delete();
            }
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('msg', 'Product deleted successfullly')->with('type', 'success');
    }
}
