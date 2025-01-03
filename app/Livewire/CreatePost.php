<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Post;

use App\Http\Controllers\TTSController;
use App\Services\GroqService;
use App\Services\PexelsService;
use App\Services\ImageUtilsService;
use App\Services\InstagramService;
use App\Services\ImgbbService;

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

    public $categoriaSelecionada;
    public $imageFromWeb;
    public $image;
    public $consulta;
    public $consultaGerada;
    public $images;
    public $currentTag;
    public $tags = [];
    public $date;
    public $time;
    public $post_id;

    public $instagramDescription;

    public $testImage;

    public $toggleHiddenPost;
    public $toggleFeaturedPost;
    public $togglePostWithInstagram;

    public function mount($title = '', $slug = '', $mensagem = '', $tags = '', $category_id = null, $date = null, $time = null, $post_id = null){
        $this->title = $title;
        $this->slug = $slug;
        $this->mensagem = $mensagem;
        $this->tags = $tags;
        $this->categoriaSelecionada = $category_id;
        $this->date = $date ?? date('Y-m-d');
        $this->time = $time ?? date('H:i');
        $this->post_id = $post_id;
        $this->togglePostWithInstagram = false;
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
        $this->validate();
        
        $ttsController = new TTSController();

        if($this->post_id){
            $post = Post::findOrFail($this->post_id);
        }else{$post = new Post();}
        if($this->togglePostWithInstagram){
            $this->publishInstagramPost();
        }
        if($this->toggleFeaturedPost){
            $post->featured = true;
        }
        if($this->toggleHiddenPost){
            $post->hidden = true;
        }

        $post->title = $this->title;
        $post->slug = $this->slug;
        $post->body = $this->mensagem;
        $post->tags = $this->tags;
        $post->category_id = $this->categoriaSelecionada;
        $post->published_at = $this->date ." ". $this->time;
        $post->user_id = Auth::user()->id;

        $post->image = $this->handleImageUpload($post);  
        $audio_path = $ttsController->synthesize($this->mensagem, $this->slug);
        $post->audio = $audio_path;

        $post->save();
        return redirect('books/1');
    }

    protected function handleImageUpload($post){
        if($this->imageFromWeb){
            $post->image = $this->imageFromWeb['src']['medium'];
        }else if($this->imageUpload){
            $imageName = $this->slug . "." . $this->imageUpload->extension();
            $this->imageUpload->storeAs('uploads/images', $imageName,'public');
            $post->image = 'uploads/images/' . $imageName;
        }
        return $post->image ?? null;
    }


    public function generateInstagramPost(){
        $this->generateEditedImage();
        $this->generateEditedDescription();
    }

    public function generateEditedImage(){
        // Obtém a imagem a ser processada (URL do Pexels ou UploadedFile)
        $imageSource = $this->imageFromWeb['src']['large'] ?? $this->imageUpload;
    
        if (!$imageSource) {
            return;
        }
        
        $this->testImage = (new ImageUtilsService)->generateEditedImage($imageSource, $this->title);
    }

    public function generateEditedDescription(){
        $content = strip_tags(Str::limit($this->mensagem, 600)) . ' Acesse o link na bio ou do stories para ler o restante da mensagem!';
        $this->instagramDescription = $content;
    }

    public function publishInstagramPost()
    {
        $instagramService = new InstagramService;
        $imgbbService = new ImgbbService;
        
        // Gerar um nome único para a imagem
        $imageName = uniqid('instagram_post_') . '.jpg';
        $imageUrl = $imgbbService->uploadImage($this->testImage);

        // cria e posta o container
        $container = $instagramService->createPostContainer($imageUrl, $this->instagramDescription);
        $instagramService->publishPost($container);
    }
                               
    

    public function addTag(){
        if(!$this->tags){
            $countTags = 0;
        }else{
            $countTags = count($this->tags);
        }
        $index = $countTags + 1;
        $this->tags[$index] = $this->currentTag;
        $this->reset('currentTag');
    }
    public function removeTag($index){
        if(isset($this->tags[$index])){
            unset($this->tags[$index]);

            $this->tags = array_values($this->tags);
        }
    }

    public function render()
    {
        $categorias = Category::all();
        return view('livewire.create-post',["categorias" => $categorias]);
    }
}
