<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm'
        ]);

        $file_name = time() . '.' . $request->video->getClientOriginalExtension();

        $request->video->move('upload', $file_name);
        $path= 'upload/' . $file_name;
        Video::create([
            'video' => $path
        ]);
        $image_path = asset($path);

        return true;
    }

}
