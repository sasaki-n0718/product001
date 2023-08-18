<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApprovalController extends Controller
{
    public function home(Post $post)
    {
        return view('approval.home')->with(['posts'=>$post->getPaginate()]);
    }
    public function post()
    {
        return view('approval.post');
    }
    public function store(Request $request,Post $post)
    {
        $input=$request['post'];
        $post->fill($input)->save();
        return redirect('/');
    }
}
