<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\CouponRequest;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupon::latest('id')->paginate(10);
        $products = Product::all();
        return view('admin.coupons.index', compact('coupons', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.coupons.create', compact('products'));
    }

    public function store(CouponRequest $request)
    {
        // return $request->all();
        Coupon::create([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'usage' => $request->usage,
            'product_id' => $request->product_id,
        ]);

        return redirect()->route('admin.coupons.index')->with('msg', 'Coupon created successfullly')->with('type', 'success');
    }

    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        return $coupon;
    }

    public function update(Request $request)
    {
        $coupon = Coupon::findOrFail($request->id);
        $coupon->update([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'value' => $request->value,
            'expire' => $request->expire,
            'usage' => $request->usage,
            'product_id' => $request->product_id
        ]);

        return $coupon;
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('admin.coupons.index')->with('msg', 'Coupon deleted successfullly')->with('type', 'danger');
    }
}
