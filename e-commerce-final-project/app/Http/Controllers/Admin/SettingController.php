<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings');
    }

    public function store(Request $request)
    {
        $logo = setting('logo');
        if($request->hasFile('logo')) {
            $logo = $request->file('logo')->store('uploads/logo', 'custom');
        }

        setting()->set('site_name', $request->site_name);
        setting()->set('logo', $logo);
        setting()->set('facebook', $request->facebook);
        setting()->set('twitter', $request->twitter);

        setting()->save();

        return redirect()->back();
    }
}
