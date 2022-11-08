<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $count = 10;
        if($request->has('count')) {
            $count = $request->count;
        }

        $posts = Post::orderByDesc('id')->paginate($count);

        if($request->has('search')) {
            $posts = Post::where('title', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate($count);
        }

        // $posts = Post::orderByDesc('id')->simplepaginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create_post');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:250',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'content' => 'required|min:10',
        ]);

        $image = null;
        $path = null;
        if ($request->hasFile('image')) {
            $image = "post-" . time() . "." . $request->image->getClientOriginalExtension();
            $path = $request->image->move('images/posts', $image);
        }

        Post::create([
            'title' => $request->title,
            'image' => $path,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('admin.posts.index');
    }
}
