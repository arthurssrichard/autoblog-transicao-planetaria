<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\TTSController;
use App\Services\GoogleTextToSpeechService;
use App\Services\PdfService;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $ttsService;

    public function __construct(GoogleTextToSpeechService $ttsService)
    {
        $this->ttsService = $ttsService;
    }

    public function autoCreate(Request $request){
        $title = $request->input('title');
        $slug = Str::slug($title); //(new SlugNormalizer)->normalize($title);
        
        $title = preg_replace('/\./','',$title);

        $bookId = $request->input('book_id');
        $book = Book::findOrFail($bookId);

        $mensagem = (new PdfService)->exibirMensagem($title,$book);
        $mensagem = (new PdfService)->formatarMensagem($mensagem, $title, $book);

        return view('admin.posts.create',['title' => $title, 'slug'=>$slug, 'mensagem'=>$mensagem]);
    }

    public function create(){
        return view('admin.posts.create',[
            'title' => '',
            'slug' => '',
            'mensagem' => '',
        ]);
    }

    public function indexAdmin(){
        return view('admin.posts.index');
    }

    // PARA O PÚBLICO
    public function index(){
        return view('posts.index');
    }
    public function store(Request $request){
        $post = new Post();

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        $audio_path = (new TTSController($this->ttsService))->synthesize($request->body, $request->slug);
        $post->audio = $audio_path;
        
        $post->save();

        return redirect('books/1');
    }

    public function show($slug){
        $post = Post::where('slug','=',$slug)->first();
        return view('posts.show',['post'=>$post]);
    }
}
