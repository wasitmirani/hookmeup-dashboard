<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getThumbnailAttribute($value)
    {
        if(!empty($value))
        return asset('/img/articles/'.$value);
        else
        return asset('/img/articles/default.png');
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));

    }
    public function postArticle($request,$type="create"){

        if ($request->hasfile('thumbnail')) {
        $thumbnail=SingleImgUpload($request,'img/articles');
        }
        else {
            if($type=="update"){
               $article= Article::where('id',$request->id)->first();
               $thumbnail=$article->thumbnail;
            }
            else {
                $thumbnail="";
            }

        }
        $requestInput=[
            'title'=>$request->title,
            'description'=>$request->description,
            'user_id'=>$request->user_id,
            'thumbnail'=>$thumbnail,
            'short_description'=>$request->short_description,
        ];
        if($type=="update"){
            return Article::where('id',$request->id)->update($requestInput);
        }
        else {
            return   Article::create($requestInput);
        }


    }
}
