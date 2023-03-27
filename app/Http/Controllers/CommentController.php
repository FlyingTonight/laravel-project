<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
class CommentController extends Controller
{
    public function store(Request $request)
    {

        $comment = Comment::create([
            'body'=> $request->body,
            'post_id'=>$request->post_id,
            'user_id'=> auth()->id(),
        ]);
        $post =Post::find($request->post_id);

       return redirect()->back();
    }
}
