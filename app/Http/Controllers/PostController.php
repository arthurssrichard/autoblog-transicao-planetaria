<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfService;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function autoCreate(Request $request){
        $title = $request->input('title');
        $slug = Str::slug($title); //(new SlugNormalizer)->normalize($title);
        
        $title = preg_replace('/\./','',$title);

        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);

        $mensagem = (new PdfService)->exibirMensagem($title,$book);
        $mensagem = (new PdfService)->formatarMensagem($mensagem, $title, $book);

        return view('posts.create',['title' => $title, 'slug'=>$slug, 'mensagem'=>$mensagem]);
    }

    public function store(Request $request){
        $post = new Post();

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('books/1');
    }

    public function show($id){
        $post = Post::findOrFail($id);
    }
}
