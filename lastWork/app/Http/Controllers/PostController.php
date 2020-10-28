<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::where('active', 1)->orderBy('created_at', 'desc')->paginate(5);
        return response()->json($posts);
    }

    public function create(Request $request)
    {
        if ($request->user()) {
            $post = new Posts();
            $post->author_id = $request->input("author_id");
            $post->title = $request->input("title");
            $post->body = $request->input("body");
            $post->save();

            return response()->json([
                "message" => "success create"
            ], 201);
        } else {
            return response()->json([
                "message" => 'You have not sufficient permissions for writing post'
            ], 400);
            }
    }

    public function update(Request $request){

    }
}

