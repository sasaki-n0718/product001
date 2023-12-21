<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
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
        return view('approval.post');
    }
    
    /*public function show(Post $post,Request $request,$id){
        $user=Auth::user();
        return view('approval.index')->with([
            'postbody'=>$post->postbody($request),
            'user'=>$user
            ]);
    }*/
    
    public function store(Request $request,Post $post){
        $input=$request['post'];
        $post->fill($input)->save();
        return redirect()->route('index');
    }
}
