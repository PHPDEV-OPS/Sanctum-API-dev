<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display posts
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Post::with('user')->latest()->paginate(10),
        ]);
    }


    /**
     * create post
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Post created successfully',
            'data' => $post,
        ], 201);

    }    
}
