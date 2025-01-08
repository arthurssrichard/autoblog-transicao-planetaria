<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        $posts = Post::orderBy('published_at','desc')->take(12)->get();
        $featuredPosts = Post::orderBy('published_at','desc')->where('featured',1)->get();
        return view('home',['posts' => $posts, 'featuredPosts' => $featuredPosts]);
    }



    
}
