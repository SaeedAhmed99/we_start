<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use Illuminate\Support\Str;
use App\Models\Reservation;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.Homes.index');
    }

    public function create()
    {
        return view('admin.Homes.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|min:5|max:250',
        //     'description' => 'required|min:10',
        //     'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        // ]);

        $image = null;
        $path = null;
        if ($request->hasFile('image')) {
            $image = "home-" . time() . "." . $request->image->getClientOriginalExtension();
            $path = $request->image->move(public_path('images/home'), $image);
            $path = 'images/home/' . $image;
        }

        $title = $this->removescript($request->title);
        Home::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('admin.index');
    }

    private function removescript($input) {
        $input = str_replace('<script>', '', $input);
        return str_replace('</script>', '', $input);
    }

    public function featch()
    {
        $reservations = Reservation::all();
        return response()->json([
            $reservations
        ]);
    }
}
