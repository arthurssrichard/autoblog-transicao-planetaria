<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GroqService;
use App\Http\Controllers\TTSController;
use Livewire\Attributes\Rule;
use App\Services\PexelsService;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class CreatePost extends Component
{
    use WithFileUploads;

    #[Rule('required|min:2|max:50')]
    public $title;

    #[Rule('required|min:2|max:50')]
    public $slug;

    #[Rule('required|min:5')]
    public $mensagem;

    #[Rule('nullable|sometimes|image')]
    public $imageUpload;

    public $imageFromWeb;

    public $consulta;
    public $consultaGerada;
    public $images;

    public function mount($title = '', $slug = '', $mensagem = '')
    {
        $this->title = $title;
        $this->slug = $slug;
        $this->mensagem = $mensagem;  
    }

    public function generateImage(){
        $groq = new GroqService();
        $pexels = new PexelsService();

        $title = $this->title;
        $content = strip_tags($this->mensagem);
        $message = "
            Ana, preciso que você me forneça APENAS uma frase curta (1 a 3 palavras), em inglês, diretamente relacionada ao título e ao conteúdo do texto. A frase deve ser genérica e visualmente representativa, de forma que haja uma alta probabilidade de encontrar imagens correspondentes no site Pexels (por exemplo: 'Mountain landscape', 'Golden sky', 'Forest path') mas ainda tendo alguma relação com o título ou corpo. Caso não pense num termo adequado, retorne termos relacionados à natureza.

            Por favor, siga estas instruções com atenção:
            1. A frase NÃO deve conter aspas, pontuação ou qualquer outra palavra extra.
            2. Considere tanto o título quanto o corpo do texto.
            3. Responda APENAS com a frase solicitada, sem explicações adicionais.

            Título: $title 
            Conteúdo: $content 

            Lembre-se: a frase será utilizada como query de busca no Pexels, então ela deve ser genérica, visualmente clara e fácil de associar a imagens disponíveis.
        ";
        if(!$this->consulta){
            $this->consulta = $groq->message($message);
            
            $pattern = '/"(.*?)"/';
            if(preg_match_all($pattern, $this->consulta, $matches)){
                $this->consulta = implode(' ', $matches[1]);
            }
        }
        $this->images = $pexels->photos($this->consulta, 10)['photos'];

        //pega a query e procura no pexels
    }

    public function toggleImage($imageId){
        $this->imageFromWeb = collect($this->images)->firstWhere('id',$imageId);
        $this->reset('imageUpload');
    }

    public function updatedImageUpload(){
        $this->reset('imageFromWeb');
    }

    public function store(){
        $post = new Post();

        $ttsController = new TTSController();
        
        $this->validate();

        $audio_path = $ttsController->synthesize($this->mensagem, $this->slug);

        if($this->imageFromWeb){
            $post->image = $this->imageFromWeb['src']['medium'];
        }else if($this->imageUpload){
            $imageName = $this->slug . "." . $this->imageUpload->extension();

            $this->imageUpload->storeAs('uploads/images', $imageName,'public');

            $post->image = 'uploads/images/' . $imageName;
        }

        $post->title = $this->title;
        $post->slug = $this->slug;
        $post->body = $this->mensagem;
        $post->audio = $audio_path;
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect('books/1');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
