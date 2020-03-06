<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    //
    // public function __construct()
    // {

    //     $this->middleware('auth');
    // }
    public function home(){
        return view('home');
    }
    public function contact(){
        return view('contact');
    }
    public function blogPost($id, $welcome = 1){

            $pages = [
                1 => [
                    'title' => 'Hello From page 1'
                ],
                2 => [
                    'title' => 'Hello From page 2'
                ],
            ];
            $welcomes = [1 => 'Hello', 2 => 'Welcome to'];
            // return $id.$author;
            return view('blog-post', [
                'data' => $pages[$id],
                'welcome' => $welcomes[$welcome],
            ]);

    }
}
