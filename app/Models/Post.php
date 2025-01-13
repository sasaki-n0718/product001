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
    
    public function searchIndex($search_title,$search_user,$accept_yn,$user,int $limit_count=5){
        $query=Post::query()->whereHas('accepts',function($q)use($user,$accept_yn){
            $q->where('post_user.user_id',$user->id)->where('post_user.accept',$accept_yn);
        });
        if(!empty($search_title)){
            $query->where('title','LIKE',"%{$search_title}%")->get();
        }
        if(!empty($search_user)){
            $query->whereHas('user',function($q)use($search_user){
                $q->where('name','LIKE',"%{$search_user}%");
            })->get();
        }
        return $posts=$query->orderBy('updated_at','DESC')->paginate($limit_count)->withQueryString();
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
