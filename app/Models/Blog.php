<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
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
        return asset('/img/blogs/'.$value);
        else
        return asset('/img/blogs/default.png');
    }
    public function postBlog($request,$type="create"){
        if ($request->hasfile('thumbnail')) {
            $thumbnail=SingleImgUpload($request,'img/blogs');
            }
            else {
                if($type=="update"){
                   $blog= Blog::where('id',$request->id)->first();
                   $thumbnail=$blog->thumbnail;
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
            return Blog::where('id',$request->id)->update($requestInput);
        }
        else {
            return   Blog::create($requestInput);
        }


    }
}
