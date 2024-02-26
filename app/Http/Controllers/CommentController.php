<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request,Comment $comment){
        $user_id=Auth::user()->id;
        $post_id=$request->id;
        $body=$request->input('body');
        $comment->create(['body'=>$body,'post_id'=>$post_id,'user_id'=>$user_id]);
        return redirect()->route('show',['id'=>$post_id]);
    }
}
