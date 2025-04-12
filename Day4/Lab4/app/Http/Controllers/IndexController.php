<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Storage;



class IndexController extends Controller
{
    ///================== Mian Method show all posts ===============================
    public function index() //camelCase
    {
        $posts = Post::with('user')->paginate(5);
        return view('posts.index',  compact('posts'));
    }

    ///================== Create Posts  Method   ===============================

    public function create() //camelCase
    {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    //================== store post ======================== 
    public function store(StorePostRequest $request)
    {
        //1-get the data
        //2- store the data in database
        //3- redirect to posts index page

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'slug' => Str::slug($title),
            'user_id' => $postCreator,
            'image' => $imagePath

        ]);

        return to_route('posts.index')->with('success', 'Post created successfully!');
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


    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->post_creator,
        ]);

        return to_route('posts.index');
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