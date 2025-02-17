<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Services\PdfService;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view("admin.books.index", ['books'=> $books]);
    }

    public function create(){
        return view("admin.books.create");
    }

    public function store(Request $request){
    
        $book = new Book;
        
        $book->nome = $request->title;
        $book->inicio_indice = $request->inicio_indice;
        $book->fim_indice = $request->fim_indice;

        $book->paginas_indice = range($request->pg_inicio, $request->pg_fim);

        // Salva o arquivo e seu endereço no database
        if($request->hasFile('book') && $request->file('book')->isValid()){
            $bookFile = $request->file('book');
            $bookName = md5($request->book->getClientOriginalName() . strtotime("now")).".".$request->book->extension();
            $bookFile->storeAs('uploads/books',$bookName,'public');
            $book->path = 'uploads/books/'.$bookName;
        }else{
            if(!$request->hasFile('book')){
                dd("sem arquivo book");
            }
            if(!$request->file('book')->isValid()){
                dd("tem arquivo livro mas nao é valido");
            }
        }
        
        $book->save();
        return redirect('/blogadmin/books');
    }

    public function show($id){
        $book = Book::findOrFail($id);
        $capitulos = (new PdfService)->capitulos($book);

        return view("admin.books.show",["capitulos"=>$capitulos, "book"=>$book]);
    }

    public function destroy($id){
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->back()->with('success', 'Livro deletado com sucesso.');
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
