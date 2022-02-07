<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEvents()
    {
        //
        $query=request('query');
        $events=Event::where('title', 'like', '%' . $query . '%')->latest()->with('user')->get();
        return response()->json(['events'=>$events]);
    }

    public function getEvent(Request $request){
        $event=Event::where('id',$request->id)->first();
        return response()->json(['event'=>$event]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createEvent(Request $request)
    {
        $event=new Event();

        $new_event=$event->postEvent($request,'create');
        return response()->json($new_event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateBlog(Request $request)
    {
        $event=new Event();
        $update_event=$event->postevent($request,'update');
        return response()->json($update_event);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function deleteBlog(Request $request)
    {

        return Event::destroy($request->id);
        //
    }
}
