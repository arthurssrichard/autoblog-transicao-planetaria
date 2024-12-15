<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GroqService;
use App\Services\PexelsService;
use Livewire\WithFileUploads;


class CreatePost extends Component
{
    use WithFileUploads;

    public $title;
    public $slug;
    public $mensagem;
    public $images;
    public $image;
    public $consulta = '';

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
        Para a próxima tarefa, quero que aja como Ana. Ana é uma funcionária objetiva e interessada em literatura.

        Ana, vou te fornecer um título de um blogpost, e você deve ler esse texto e fornecer uma frase com 1 (uma) até 3 (três) palavras em inglês baseado no texto, dando maior prioridade ao título.

        Para maior contextualização, você faz parte de um projeto chamado Autoblog, do blog transicaoplanetaria.com, um blog com várias mensagens espíritas. Segue a descrição do site:
        Aqui você vai encontrar todas as informações sobre Transição Planetária, o que este processo tanto impacta na humanidade, reforma íntima, encarnação chave, oportunidade de melhoria e principalmente instrumentos para direcionar sua mente e suas atitudes voltadas ao próximo. Sem Caridade não há Salvação. Paz e Luz !

        Ana, a frase será utilizada para uma consulta automática no pexels por imagens relacionadas para adicionar no texto. Muitas vezes as imagens são relacionadas à natureza e paisagens, mas não é uma regra.

        Ana, gere a frase pensando nos possíveis resultados no Pexels, de forma que haja pouca chance de poucos ou nenhum resultado ser exibido. Além disso, retorne apenas a mensagem, para que o conteúdo da sua resposta seja diretamente colocado na API do pexels. Ou seja, responda APENAS a frase que foi solicitada, sem nenhum conteúdo de texto a mais.

        Exemplo:
        'A natureza é muito bonita'
        sua resposta será algo como:
        'Nature'
        Nada além disso.
        Outro exemplo:
        'A humanidade caminha em passos largos para a guerra'
        sua resposta será algo como:
        'Dark road on the forest'

        Agora, segue o título: $title
        Considere também o texto, mas bem menos que o título:
        $content
        ";
        $generatedQuery = $groq->message($message);
        $this->consulta = $generatedQuery;

        //pega a query e procura no pexels
        $this->images = $pexels->photos($generatedQuery, 4)['photos'];
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
