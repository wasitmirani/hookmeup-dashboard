<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Event;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(){
        $blogs=Blog::all()->count();
        $articles=Article::all()->count();
        $events=Event::all()->count();
        $users_collection=User::all();
        $users_collection=collect($users_collection);
        $users=$users_collection->count();
        $free_members=$users_collection->where('plane_id',1)->count();
        $customize_members=$users_collection->where('plane_id',2)->count();
        $premium_members=$users_collection->where('plane_id',3)->count();
        $users=(object)[
            'total'=>$users,
            'free_members'=>$free_members,
            'customize_members'=>$customize_members,
            'premium_members'=>$premium_members,
        ];
        return response()->json(['blogs'=>$blogs,'articles'=>$articles,'events'=>$events,'users'=>$users]);
    }
   
    public function getBlogs()
    {
        //
        $query=request('query');
        $blogs=Blog::where('title', 'like', '%' . $query . '%')->latest()->with('user')->get();
        return response()->json(['blogs'=>$blogs]);
    }

    public function getBlog(Request $request){
        $blog=Blog::where('id',$request->id)->first();
        return response()->json(['blog'=>$blog]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBlog(Request $request)
    {
        $blog=new Blog();

        $new_blog=$blog->postBlog($request,'create');
        return response()->json($new_blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateBlog(Request $request)
    {
        $blog=new Blog();
        $update_blog=$blog->postblog($request,'update');
        return response()->json($update_blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function deleteBlog(Request $request)
    {

        return Blog::destroy($request->id);
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
