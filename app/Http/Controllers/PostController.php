<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        dd($request);
    }
}
