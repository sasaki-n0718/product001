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
    public function group(){
        return $this->belongsTo(Group::class);
    }
    
    public function searchIndex($keyword,int $limit_count=5){
        $query=Post::query();
        if(!empty($keyword)){
            $query->where('title','LIKE',"%{$keyword}%")->get();
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
