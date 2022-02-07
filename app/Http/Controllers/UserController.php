<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function users(){
        $query=request('query');
        $users=User::where('name', 'like', '%' . $query . '%')->latest()->with('plane')->get();
        return response()->json(['users'=>$users]);
    }



}
