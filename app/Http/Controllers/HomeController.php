<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class HomeController extends Controller
{
    public function index(){

        // teste de deleterar
        $tempPath = public_path('storage/temp');
        $files = File::files($tempPath);
        foreach ($files as $file) {
            File::delete($file->getPathname());
        }

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
        return view ('policy');
    }

}
