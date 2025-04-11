<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    ///================== Mian Method show all posts ===============================
    public function index() //camelCase
    {
        // $posts = Post::all();

        $posts = Post::with('user')->paginate(5);

        // $posts = Post::with('user') // Eager load user relationship
        // ->orderBy('created_at', 'desc') // Optional: newest first
        // ->paginate(10); // 10 posts per page

        // compact('posts') ;
        // return view('posts.index', ['posts' => $posts]);

        return view('posts.index',  compact('posts'));
    }

    ///================== Create Posts  Method   ===============================

    public function create() //camelCase
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    //================== store post ======================== 
    public function store(Request $request)
    {
        //1-get the data
        //2- store the data in database
        //3- redirect to posts index page

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator
        ]);

        return to_route('posts.index');
    }

    ///================== Show Posts  Method   ===============================

    public function show(string $id)
    {
        $post = Post::find($id);


        return view('posts.show', ['post' => $post]);
    }

    //================= edit ==================
    public function edit($id)
    {
        $post = Post::findOrFail($id); // This will automatically 404 if not found
        $users = User::all(); // Get all users for the dropdown

        return view('posts.edit', [
            'post' => $post,
            'users' => $users
        ]);
    }
    //=================== update  ===========================

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'post_creator' => 'nullable|exists:users,id' // Changed to nullable
        ]);

        $post = Post::findOrFail($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator // Can be null
        ]);

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }


    //================== Delete =========================
    public function destroy($id)
    {
        // Find and delete the post
        $post = Post::findOrFail($id);
        $post->comments()->delete();
        $post->delete();
       

        // Redirect with success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}