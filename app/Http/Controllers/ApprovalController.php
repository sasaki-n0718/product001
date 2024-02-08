<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index(Post $post,Request $request){
        $user=Auth::user();
        $keyword=$request->input('keyword');
        $id=$request->id;
        return view('approval.index')->with([
            'posts'=>$post->searchIndex($keyword),
            'postbody'=>$post->postbody($id),
            'user'=>$user
        ]);
    }
    
    public function post(){
        return view('approval.post')->with([
            'groups'=>Auth::user()->groups()->get(),
            ]);
    }

    public function store(Request $request,Post $post){
        $input=$request['post'];
        $input['user_id']=Auth::user()->id;
        $post->fill($input)->save();
        return redirect()->route('index');
    }
}
