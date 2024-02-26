<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function accepts(){
        return $this->belongsToMany(User::class)->withPivot('accept');
    }
    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function attachments(){
        return $this->hasMany(Attachment::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
    public function searchIndex($keyword,$user,int $limit_count=5){
        $query=Post::query()->whereHas('accepts',function($q)use($user){
            $q->where('post_user.user_id',$user->id);
        });
        /*dd($query);*/
        if(!empty($keyword)){
            $query->where('title','LIKE',"%{$keyword}%")->get();
        }
        else{
            $query->whereHas('accepts',function($q)use($user){
                $q->where('post_user.user_id',$user->id)->where('post_user.accept',false);
            })->get();
        }
        return $posts=$query->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    
    public function postbody($id){
        $postbody=null;
        if(!empty($id)){
            $postbody=Post::find($id);
        }
        return $postbody;
    }
    
    protected $fillable =[
        'title',
        'body',
        'group_id',
        'user_id',
        ];
}
