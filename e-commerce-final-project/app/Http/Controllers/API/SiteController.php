<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function contact(Request $request)
    {
        $data = $request->except('cv');
        $cv = $request->file('cv')->store('uploads/cv', 'custom');
        $data['cv'] = $cv;
        Mail::to($request->email)->queue(new ContactMail($data));
        return $request->all();
    }
}
