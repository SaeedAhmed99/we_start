<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Reservation;

class FrontController extends Controller
{
    public function index()
    {
        $homes = Home::latest()->get();
        return view('front.index', compact('homes'));
    }

    public function homeDetails($id)
    {
        $home = Home::findOrFail($id);
        return view('front.detailsHome', compact('home'));
    }

    public function chooseHome(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'date' => 'required',
        ]);

        if (str_contains(date('D/m/Y', strtotime($request->date)), 'Fri') === true or str_contains(date('D/m/Y', strtotime($request->date)), 'Thu') === true) {
            return response()->json([
                'specialPrice' => 'yes'
            ]);
        } else {
            Reservation::create([
                'date' => $request->date,
                'home_id' => $request->id,
            ]);
            return true;
        }

    }
}
