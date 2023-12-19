<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function index(Request $request,Post $post)
    {
        $user=Auth::user();
        return view('approval.index')->with(['posts'=>$post->searchIndex($request),'user'=>$user]);
    }
    public function post()
    {
        return view('approval.post');
    }
    public function store(Request $request,Post $post)
    {
        $input=$request['post'];
        $post->fill($input)->save();
        return redirect()->route('index');
    }
}
