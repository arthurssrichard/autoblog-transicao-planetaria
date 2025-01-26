<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        $posts = Post::published()
        ->orderBy('published_at','desc')->take(12)->get();
        $featuredPosts = Post::orderBy('published_at','desc')->where('featured',1)->get();
        return view('home',['posts' => $posts, 'featuredPosts' => $featuredPosts]);
    }

    public function sobreNos(){
        return view('sobre-nos');
    }

    public function introducao(){
        return view('introducao');
    }
    
    public function contato(){
        return view('contato');
    }

    public function politicaDePrivacidade(){
        $policy = 'oioi';
        return view ('policy',["policy"=>$policy]);
    }

}
