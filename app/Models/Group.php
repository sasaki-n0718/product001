<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    
    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function posts(){
        return $this->hasMany(Post::class);
    }
    
    public function group_member($group_id){
        return $members=Group::find($group_id)->users()->get(['user_id',])->toArray();
    }

    protected $fillable=[
        'name',
        ];
}
