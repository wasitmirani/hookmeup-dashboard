<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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
        return asset('/img/events/'.$value);
        else
        return asset('/img/events/default.png');
    }
    public function postEvent($request,$type="create"){
        if ($request->hasfile('thumbnail')) {
            $thumbnail=SingleImgUpload($request,'img/events');
            }
            else {
                if($type=="update"){
                   $event= Event::where('id',$request->id)->first();
                   $thumbnail=$event->thumbnail;
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
            return Event::where('id',$request->id)->update($requestInput);
        }
        else {
            return   Event::create($requestInput);
        }


    }
}
