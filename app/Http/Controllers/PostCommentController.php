<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(Post $post, Request $request)
    {
        //validation
        $request->validate([
            'body' => 'required'
        ]);
        //add the comments to the given post.
        $post->comments()->create([
            'user_id' => $request->user()->id, //auth()->id(),auth()->user()->id,
            'body' => $request->input('body')
        ]);
        //redirect
        return back();
    }
}
