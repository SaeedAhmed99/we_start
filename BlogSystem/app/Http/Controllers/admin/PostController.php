<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Traits\LogsTrait;

class PostController extends Controller
{
    use LogsTrait;

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
            'title' => 'required|min:10|max:250',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'content' => 'required|min:10',
        ]);

        $image = null;
        $path = null;
        if ($request->hasFile('image')) {
            $image = "post-" . time() . "." . $request->image->getClientOriginalExtension();
            $path = $request->image->move(public_path('images/posts'), $image);
            $path = 'images/posts/' . $image;
        }

        $title = $this->removescript($request->title);
        Post::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'image' => $path,
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);
        $this->logs('create', 'create post (' . substr($title, 0, 10) . ' ...) by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

        return redirect()->route('admin.posts.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit_post', compact('post'));
    }

    public function update(Request $request)
    {
        $post = Post::find($request->id);
        if ($post) {
            $request->validate([
                'title' => 'required|min:5|max:250',
                'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
                'content' => 'required|min:10',
            ]);

            $image = null;
            $path = null;
            $path = $post->image;
            if ($request->hasFile('image')) {
                File::delete(public_path($path));
                $image = "post-" . time() . "." . $request->image->getClientOriginalExtension();
                $path = $request->image->move(public_path('images/posts'), $image);
                $path = 'images/posts/' . $image;
            }

            $title = $this->removescript($request->title);
            $post->update([
                'title' => $title,
                'slug' => Str::slug($title),
                'image' => $path,
                'content' => $request->content,
                'user_id' => Auth::user()->id,
            ]);
            $this->logs('update', 'update post (' . substr($title, 0, 10) . ' ...) by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);

            return view('admin.posts.edit_post', compact('post'));
        } else {
            return route('admin.posts.index');
        }

    }

    private function removescript($input) {
        $input = str_replace('<script>', '', $input);
        return str_replace('</script>', '', $input);
    }

    public function destroy($id) {
        $post = Post::find($id);
        if ($post) {
            $this->logs('trash', 'This post ('. substr($post->title, 0, 10) . ' ...) has been moved to the trash by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);
            $post->delete();
        }
        return redirect()->back();
    }

    public function trash(Request $request)
    {
        $count = 10;
        if($request->has('count')) {
            $count = $request->count;
        }

        $posts = Post::onlyTrashed()->orderByDesc('deleted_at')->paginate($count);

        if($request->has('search')) {
            $posts = Post::where('title', 'like', '%'.$request->search.'%')->orderByDesc('id')->paginate($count);
        }

        return view('admin.posts.trash', compact('posts'));
    }

    public function forcedelete($id) {
        $post = Post::onlyTrashed()->find($id);
        if ($post) {
            $this->logs('delete', 'This post ('. substr($post->title, 0, 10) . ' ...) has been permanently deleted by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);
            File::delete(public_path($post->image));
            $post->forceDelete();
        }
        return redirect()->back();
    }

    public function restore($id)
    {
        $post = Post::onlyTrashed()->find($id);
        $this->logs('restore', 'This post ('. substr($post->title, 0, 10) . ' ...) has been restored from the trash by ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);
        $post->restore();
        return redirect()->route('admin.posts.index');
    }
}
