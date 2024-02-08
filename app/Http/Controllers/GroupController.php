<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;


class GroupController extends Controller
{
    public function create(){
        $users=User::all();
        return view('approval.group')->with(['users'=>$users]);
    }
    
    public function store(Request $request,Group $group){
        $group->name=$request->input('groupname');
        $group->save();
        foreach($request->members as $user_id){
            $group->users()->attach($user_id);
        }
        return redirect()->route('index');
    }
}
