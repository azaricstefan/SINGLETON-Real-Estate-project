<?php

namespace RealEstate\Http\Controllers;

use Illuminate\Http\Request;

use RealEstate\Http\Requests;
use RealEstate\Comment;

class CommentController extends Controller
{
    public function add(Request $request)
    {
        $comment = new Comment();
        $comment->body = $request->body;
        $comment->ad_id = $request->ad_id;
        $comment->user_id = \Auth::user()->user_id;

        $comment->save();
        return redirect()->back();
    }

    public function report(Comment $id)
    {
        $id->reported = 1;
        $id->save();
        return redirect()->back();
    }
}
