<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function do_qr_code_builder(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required',
            'body' => 'required'
        ]);

        $name = Str::slug($request->name) . '.png';


        $qr = QrCode::format('png')->generate($request->body, '../public/qr_code/' . $name);
        // $qr = QrCode::generate($request->body);

        return back()->with([
            'status' => 'QR Code generated successfully!',
            'image' => $name
        ]);

    }
}
