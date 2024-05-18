<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required',
                'image' => 'required',
                'description' => 'required',
            ]);

            $data['user_id'] = Auth::id();
            $data['image'] = 'post_images' . '/' . $this->uploadImage($request->image, 'post_images');
            $data['slug'] = $this->generateUniqueSlug($request->title);

            Post::create($data);

            return redirect()->route('posts.index')->with('success', 'Post created successfully.');

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $post = Post::with('comments')->find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        try {
            $data = $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            
            $data['user_id'] = Auth::id();
            
            if ($request->hasFile('image')) {
                
                $data['image'] = 'post_images' . '/' . $this->uploadImage($request->file('image'), 'post_images');
            }
            
            if ($post->title !== $request->title) {
                $data['slug'] = $this->generateUniqueSlug($request->title);
            } else {
                $data['slug'] = $post->slug;
            }
            
            $post->update($data);
            
            return redirect()->route('posts.index')->with('success', 'Post updated successfully.');

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    protected function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $uniqueSlug = $slug;
        $counter = 1;
        while (Post::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }
        return $uniqueSlug;
    }
}
