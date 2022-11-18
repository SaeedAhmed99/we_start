<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json([
            $courses
        ]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'title' => 'required|min:5',
        //     'description' => 'required',
        //     'image' => 'nullable|mimes:png,jpg',
        //     'price' => 'required',
        //     'discount' => 'nullable'
        // ]);


        $image = null;
        $path = null;
        if ($request->hasFile('image')) {
            $image = "course-" . time() . "." . $request->image->getClientOriginalExtension();
            $path = $request->image->move(public_path('images/courses'), $image);
            $path = 'images/courses/' . $image;
        }
        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'price' => $request->price,
            'discount' => $request->discount
        ]);


    }
}
