<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create()
    {
        $users = User::all();
        //dd($users);
        return view('posts.create', compact('users'));

    }
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'creator' => 'required|exists:users,id',
            'comment' => 'required|string|max:500'
        ]);
    
        $post = Post::findOrFail($request->post_id);
        
        $post->comments()->create([
            'comment' => $request->comment,  // Use 'content' instead of 'comment'
            'user_id' => $request->creator,
        ]);
    
        return back()->with('success', 'Comment added!');    
    }
    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function edit(Comment $comment)
    {
        $users = User::all();
        return view('comments.edit', compact('comment', 'users'));
    }

    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'comment' => $request->comment,
            'user_id' => $request->creator,
        ]);
        return redirect()->route('posts.show', $comment->commentable->id)
        ->with('success', 'Comment updated!');
    }
}