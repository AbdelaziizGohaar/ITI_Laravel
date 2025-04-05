<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    ///================== Mian Method show all posts ===============================
    public function index() //camelCase
    {
        $posts = [
            ['id' => 1, 'title' => 'First Post', 'posted_by' => 'Ahmed', 'created_at' => '2025-11-10 10:00:00'],
            ['id' => 2, 'title' => 'Second Post', 'posted_by' => 'Mohamed', 'created_at' => '2025-11-10 10:00:00'],
            ['id' => 3, 'title' => 'Third Post', 'posted_by' => 'Cr7', 'created_at' => '2025-11-10 10:00:00'],
            ['id' => 4, 'title' => 'Special Post', 'posted_by' => 'Gohar', 'created_at' => '2007-7-7 17:00:00']
        ];

        return view('posts.index', ['posts' => $posts]);
    } 

    ///================== Create Posts  Method   ===============================

    public function create() //camelCase
    {
        return view('posts.create');
    }

    //================== store post ======================== 
    public function store(Request $request)
    {
        dd($request->all());
        return to_route('posts.index');
        
        // return redirect()->route('posts.index');
    }

    ///================== Show Posts  Method   ===============================


    public function show($postId)
    {
        $posts = [
            [
                'id' => 1,
                'title' => 'First Post',
                'posted_by' => 'Ahmed',
                'created_at' => '2025-11-10 10:00:00',
                'description' => 'First post description'
            ],
            [
                'id' => 2,
                'title' => 'Second Post',
                'posted_by' => 'Mohamed',
                'created_at' => '2025-11-10 10:00:00',
                'description' => 'Second post description'
            ],
            [
                'id' => 3,
                'title' => 'Third Post',
                'posted_by' => 'Cr7',
                'created_at' => '2025-11-10 10:00:00',
                'description' => 'Third post description'
            ],
            [
                'id' => 4,
                'title' => 'Special Post',
                'posted_by' => 'Gohar',
                'created_at' => '2007-7-7 17:00:00',
                'description' => 'Special post description'
            ]
        ];

        $post = collect($posts)->firstWhere('id', $postId);

        if (!$post) {
            abort(404); // Return 404 if post not found
        }

        return view('posts.show', ['post' => $post]);
    }

   //================= edit ==================
   public function edit($id)
   {
    $posts = [
        [
            'id' => 1,
            'title' => 'First Post',
            'posted_by' => 'Ahmed',
            'created_at' => '2025-11-10 10:00:00',
            'description' => 'First post description'
        ],
        [
            'id' => 2,
            'title' => 'Second Post',
            'posted_by' => 'Mohamed',
            'created_at' => '2025-11-10 10:00:00',
            'description' => 'Second post description'
        ],
        [
            'id' => 3,
            'title' => 'Third Post',
            'posted_by' => 'Cr7',
            'created_at' => '2025-11-10 10:00:00',
            'description' => 'Third post description'
        ],
        [
            'id' => 4,
            'title' => 'Special Post',
            'posted_by' => 'Gohar',
            'created_at' => '2007-7-7 17:00:00',
            'description' => 'Special post description'
        ]
        ];
      // return view('posts.edit', ['post' => $posts[$id]]);

       // Find the post by ID (not array index)
    $postToEdit = null;
    foreach ($posts as $post) {
        if ($post['id'] == $id) {
            $postToEdit = $post;
            break;
        }
    }

    if (!$postToEdit) {
        abort(404, 'Post not found');
    }

    return view('posts.edit', ['post' => $postToEdit]);

       
   }
    //=================== update  ===========================

    public function update(Request $request, $id)
    {
        dd('Updated Post', $id, $request->all());
        return to_route('posts.index');
    }
    
  //================== Delete =========================
   public function destroy($id)
   {
      dd("Deleted Post with ID: $id");
      return to_route('posts.index');
   }

    //=============================================================================================================================================

 //    Store posts in session to persist between requests
    // protected function getPosts()
    // {
    //     if (!Session::has('posts')) {
    //         Session::put('posts', [
    //             [
    //                 [
    //                     'id' => 1,
    //                     'title' => 'First Post',
    //                     'posted_by' => 'Ahmed',
    //                     'created_at' => '2025-11-10 10:00:00',
    //                     'description' => 'First post description'
    //                 ],
    //                 [
    //                     'id' => 2,
    //                     'title' => 'Second Post',
    //                     'posted_by' => 'Mohamed',
    //                     'created_at' => '2025-11-10 10:00:00',
    //                     'description' => 'Second post description'
    //                 ],
    //                 [
    //                     'id' => 3,
    //                     'title' => 'Third Post',
    //                     'posted_by' => 'Cr7',
    //                     'created_at' => '2025-11-10 10:00:00',
    //                     'description' => 'Third post description'
    //                 ],
    //                 [
    //                     'id' => 4,
    //                     'title' => 'Special Post',
    //                     'posted_by' => 'Gohar',
    //                     'created_at' => '2007-7-7 17:00:00',
    //                     'description' => 'Special post description'
    //                 ]
    //             ]
    //         ]);
    //     }
    //     return Session::get('posts');
    // }

    // protected function savePosts(array $posts)
    // {
    //     Session::put('posts', $posts);
    // }



    // //================== edit ===============
    // public function edit($postId)
    // {
    //     $posts = $this->getPosts();
    //     $post = collect($posts)->firstWhere('id', $postId);

    //     if (!$post) {
    //         abort(404);
    //     }

    //     return view('posts.edit', ['post' => $post]);
    // }

    // public function update(Request $request, $postId)
    // {
    //     $posts = $this->getPosts();

    //     $updatedPosts = array_map(function ($post) use ($postId, $request) {
    //         if ($post['id'] == $postId) {
    //             return [
    //                 'id' => $postId,
    //                 'title' => $request->title,
    //                 'posted_by' => $request->posted_by,
    //                 'description' => $request->description,
    //                 'created_at' => $post['created_at'] // Keep original creation date
    //             ];
    //         }
    //         return $post;
    //     }, $posts);

    //     $this->savePosts($updatedPosts);

    //     return redirect()->route('posts.show', $postId)
    //         ->with('success', 'Post updated successfully');
    // }



    // public function destroy($postId)
    // {
    //     $posts = $this->getPosts();

    //     $updatedPosts = array_filter($posts, function ($post) use ($postId) {
    //         return $post['id'] != $postId;
    //     });

    //     $this->savePosts($updatedPosts);

    //     return redirect()->route('posts.index')
    //         ->with('success', 'Post deleted successfully');
    // }


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|max:255',
    //         'description' => 'nullable',
    //         'posted_by' => 'required'
    //     ]);

    //     $posts = $this->getPosts();

    //     $newPost = [
    //         'id' => count($posts) + 1,
    //         'title' => $request->title,
    //         'posted_by' => $request->posted_by,
    //         'description' => $request->description,
    //         'created_at' => now()->toDateTimeString()
    //     ];

    //     $updatedPosts = array_merge($posts, [$newPost]);
    //     $this->savePosts($updatedPosts);

    //     return redirect()->route('posts.index')
    //         ->with('success', 'Post created successfully');
    // }



    
}