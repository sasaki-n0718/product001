<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Models\User;
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

    public function store(Request $request,Post $post,Group $group){
        $input=$request['post'];
        $input['user_id']=Auth::user()->id;
        $group_id=$request['post']['group_id'];
        $post->fill($input)->save();
        $members=$group->group_member($group_id);
        foreach($members as $member_id){
            $post->accepts()->attach($member_id);
        }
        return redirect()->route('show',['id'=>$post->id]);
    }
    
    public function accept(Request $request){
        $user=User::find(Auth::user()->id);
        $post_id=$request->id;
        $user->accepts()->updateExistingPivot($post_id, ['accept' => true,]);
        return redirect()->route('show',['id'=>$post_id]);
    }
}
