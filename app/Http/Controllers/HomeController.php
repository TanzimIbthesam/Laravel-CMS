<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // return dd(Auth::id());
    //     //
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        return view('home');
    }
//     To check id of current user dd(Auth::id());
// To check authenticity of current user dd(Auth::check());
// To check details of the user
// dd(Auth::user());
// To just get name of user
// dd(Auth::user()->name);

}
