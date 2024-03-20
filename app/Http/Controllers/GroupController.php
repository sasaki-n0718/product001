<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;


class GroupController extends Controller
{
    public function create(){
        $users=User::all();
        $groups=Group::all();
        return view('approval.group_create')->with(['users'=>$users,'groups'=>$groups]);
    }
    public function store(Request $request,Group $group){
        $group->name=$request->input('groupname');
        $group->save();
        foreach($request->members as $user_id){
            $group->users()->attach($user_id);
        }
        return redirect()->route('index');
    }
    public function edit(Request $request){
        $users=User::all();
        $group=Group::find($request->group_id);
        return view('approval.group_edit')->with(['users'=>$users,'group'=>$group]);
    }
    public function update(Request $request){
        $group=Group::find($request->group_id);
        $group->name=$request->input('groupname');
        $group->save();
        $group->users()->sync($request->members);
        return redirect()->route('index');
    }
    public function destroy(Request $request){
        $group=Group::find($request->group_id);
        $group->delete();
        return redirect()->route('index');
    }
}
