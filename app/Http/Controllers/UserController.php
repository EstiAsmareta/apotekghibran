<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read role');
        //tidak bisa masuk ke create
    }
    public function index(Request $request){
        $users = user::all();
        return view('manajemen_user.index',compact('users'));


    }
}
