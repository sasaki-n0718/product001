<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Models\User;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Post $post,Request $request){
        $user=Auth::user();
        $keyword=$request->input('keyword');
        $id=$request->id;
        return view('approval.index')->with([
            'posts'=>$post->searchIndex($keyword,$user),
            'postbody'=>$post->postbody($id),
            'user'=>$user,
        ]);
    }
    
    public function post(){
        return view('approval.post')->with([
            'groups'=>Auth::user()->groups()->get(),
            ]);
    }

    public function store(Request $request,Post $post,Group $group,Attachment $attachment){
        //ポスト保存
        $input=$request['post'];
        $input['user_id']=Auth::user()->id;
        $group_id=$request['post']['group_id'];
        $post->fill($input)->save();
        $members=$group->group_member($group_id);
        foreach($members as $member_id){
            $post->accepts()->attach($member_id);
        }
        unset($member_id);
        //ファイル保存
        $files=$request->file('file');
        $dir='attachment_files';
        if(!empty($files)){
            foreach($files as $file){
                $file_name=$file->getClientOriginalName();
                $file->storeAs('public/'.$dir,$file_name);
                $post->attachments()->create([
                    'name'=>$file_name,
                    'path'=>'public/'.$dir.'/'.$file_name,
                ]);
                /*$input=[
                    'post_id'=>$post->id,
                    'name'=>$file_name,
                    'path'=>'public/'.$dir.'/'.$file_name,
                ];
                $attachment->fill($input)->save();*/
            }
        }
        //リダイレクト
        return redirect()->route('show',['id'=>$post->id]);
    }
    
    public function accept(Request $request){
        $user=User::find(Auth::user()->id);
        $post_id=$request->id;
        $user->accepts()->updateExistingPivot($post_id, ['accept' => true,]);
        return redirect()->route('show',['id'=>$post_id]);
    }
    
    public function edit(Request $request,Post $post){
        return view('approval.edit')->with([
            'postbody'=>$post->postbody($request->id),
            'groups'=>Auth::user()->groups()->get(),
            ]);
    }
    
    public function update(Request $request,Post $post,Group $group){
        $post=Post::find($request->id);
        $input=$request['post'];
        $group_id=$request['post']['group_id'];
        $post->fill($input)->save();
        $members=$group->group_member($group_id);
        $post->accepts()->sync(array_keys($members));
        return redirect()->route('show',['id'=>$request->id]);
    }
}
