<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $post)
    {
        try {
            $data = $request->validate([
                'comment' => 'required',
            ]);

            $data['user_id'] = Auth::id();
            $data['post_id'] = $post;

            // dd($data);

            Comment::create($data);

            return back()->with('success', 'Comment Added successfully.');

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function show($id)
    {
        $comment = Comment::find($id);
        return view('comments.show', compact('comment'));
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        try {
            $data = $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            
            $data['user_id'] = Auth::id();
            
            if ($request->hasFile('image')) {
                
                $data['image'] = 'comment_images' . '/' . $this->uploadImage($request->file('image'), 'comment_images');
            }
            
            if ($comment->title !== $request->title) {
                $data['slug'] = $this->generateUniqueSlug($request->title);
            } else {
                $data['slug'] = $comment->slug;
            }
            
            $comment->update($data);
            
            return redirect()->route('comments.index')->with('success', 'Comment updated successfully.');

        } catch (\Throwable $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}
