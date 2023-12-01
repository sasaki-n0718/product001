<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Post extends Model
{
    use HasFactory;
    
    public function getPaginate(int $limit_count=5)
    {
        return $this->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    public function searchIndex($request,int $limit_count=5)
    {
        $keyword=$request->input('keyword');
        $query=Post::query();
        if(!empty($keyword)){
            $query->where('title','LIKE',"%{$keyword}%")->get();
        }
        return $posts=$query->orderBy('updated_at','DESC')->paginate($limit_count);
    }
    protected $fillable =[
        'title',
        'body',
        ];
}
