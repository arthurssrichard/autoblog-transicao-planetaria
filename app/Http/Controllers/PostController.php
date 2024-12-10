<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfService;
use Illuminate\Support\Str;
use App\Models\Book;

class PostController extends Controller
{
    public function create(){
        return view('posts.create');
    }

    public function autoCreate(Request $request){
        $title = $request->input('title');
        $slug = Str::slug($title); //(new SlugNormalizer)->normalize($title);
        
        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);
        $mensagem = (new PdfService)->exibirMensagem($title,$book);
        
        $mensagem = (new PdfService)->formatarMensagem($mensagem, $title, $book);

        return view('posts.create',['title' => $title, 'slug'=>$slug, 'mensagem'=>$mensagem]);
    }

    public function store(Request $request){
        dd($request);
    }
}
