<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApprovalController extends Controller
{
    public function home(Request $request,Post $post)
    {
        return view('approval.home')->with(['posts'=>$post->searchIndex($request)]);
    }
    public function search(Request $request,Post $post)
    {
        $keyword=$request->input('keyword');
        $query=Post::query();
        if(!empty($keyword)){
            $query->where('title','LIKE',"%{$keyword}%")
            ->get();
        }
        $posts=$query->paginate(5);
        /*$query->when(!empty($keyword),function($q){
            return $q->where('title', 'LIKE', "%{$keyword}%");
            });
        $posts=$query->get();*/
        
        return view('approval.home')->with(
            ['posts'=>$posts],['keyword'=>$keyword],
            );
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
