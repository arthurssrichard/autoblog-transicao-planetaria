<?php 

namespace App\Services;
use Smalot\PdfParser\Parser;
use App\Models\Book;
class PdfService
{
    function pdf(Book $book){
        $parser = new Parser();
        $filePath = storage_path('app/public/'.$book->path);
        $pdf = $parser->parseFile($filePath);
        return $pdf;
    }
    // Retorna a página bruta de capítulos
    function indice(Book $book){
        $pdf = $this->pdf($book);
        
        $inicio = $book->inicio_indice;
        $fim = $book->fim_indice;

        $index = '';
        foreach($book->paginas_indice as $page){
            $index .= $pdf->getPages()[$page-1]->getText();
        }
        $index = $this->filterIndex($index,$inicio,$fim);
        return $index;
    }

    // Retorna os capítulos bonitinhos 
    function capitulos(Book $book){
        $index = $this->indice($book);

        return $this->extractMessages($index);
    }

    function filterIndex($text, $start, $end) {
        $startPos = strpos($text, $start) + strlen($start);
        $endPos = strpos($text, $end);
    
        // Extrai o texto entre o início e o fim
        $extractedText = ($endPos !== false)
            ? substr($text, $startPos, $endPos - $startPos)
            : substr($text, $startPos);
    
        // Normaliza o índice: une linhas quebradas
        return $extractedText;
    }

    function extractMessages($text) {
        // Define o padrão para capturar os títulos
        $pattern = '/\d+\.\s+(.*?)(?=\.\.\.| \d)/';
    
        // Aplica o regex
        preg_match_all($pattern, $text, $matches);
    
        // Retorna apenas o grupo capturado (os títulos)
        return $matches[1];
    }

    function normalizeIndex($text) {
        // Remove quebras de linha seguidas de espaços
        $text = preg_replace('/\n\s*/', ' ', $text);
    
        // Remove espaços extras
        $text = preg_replace('/\s+/', ' ', $text);
    
        // Retorna o índice normalizado
        return trim($text);
    }

    function getPagesMessage($title, $index){
        // procurar páginas do livro no índice a partir do título
        $escapedTitle = preg_quote($title, '/');
        $escapedTitle = preg_replace('/\s+/','\\s*',$escapedTitle);
        $pattern1 = '/'. $escapedTitle.'[\s\S]*?(\d+)\s\d+\.\s*[\s\S]*?(\d+)/';
        $pages = null;
        if(preg_match($pattern1,$index,$matches)){
            $pages = [$matches[1],$matches[2]];
            $pages = range($pages[0],$pages[1]);
        }
        return $pages;
    }

    function exibirMensagem(String $title, Book $book){
        $index = $this->indice($book);
        $pdf = $this->pdf($book);

        // procurar páginas do livro no índice a partir do título
        $pages = $this->getPagesMessage($title, $index);
        //

        $content = '';
        foreach($pages as $page){
            $content .= $pdf->getPages()[$page-1]->getText();
        }

        $content = preg_replace("/([A-Z]+)\s\s\s([A-Z]+)/", "$1 $2",$content);
        $escapedTitle = strtoupper($title);
        $escapedTitle = preg_replace('/\s+/','\\s*',$escapedTitle);

        $pattern2 = "/($escapedTitle.*?)(?=\d+\.\s|$|\.{4,})/siu";
        if(preg_match($pattern2,$content,$matches)){
            $rawMessage = $matches[1];
            return $rawMessage;
        }
    }
    
    function formatarMensagem(String $mensagem, String $title, Book $book){
        // pegar paginas
        $index = $this->indice($book);
        $pages = $this->getPagesMessage($title, $index);
        //dd($pages);

        // retirar titulo
        $title = mb_strtoupper($title);
        $title = preg_quote($title,'/');
        $pattern = "/$title/";
        $mensagem = preg_replace($pattern,'',$mensagem);

        // retirar paginas
        foreach($pages as $page){
            $page = preg_quote($page, '/');
            $pattern = "/\s+$page\s+/";
            $mensagem = preg_replace($pattern,' ',$mensagem);
        }
        
        // separar em parágrafos
        $frases = $this->breakText($mensagem, 300);
        
        $frases[count($frases)-1] = '<br><strong>'.$frases[count($frases)-1].'</strong>'; // deixa a ultima frase negrito
        $mensagem = '';

        $dem = 0;
        
        foreach($frases as $frase){
            $mensagem .= $frase;
            $dem++;
            if($dem == 4){
                $mensagem .= "<br><br>";
                $dem = 0;
            }
        }
        
        return $mensagem;
    }

    function breakText($text, $minLength = 200, $needle='.') {
        $needle = preg_quote($needle);
        $text = $this->normalizeIndex($text);
        

        // Adiciona ponto final, se necessário
        if (!preg_match('/\.$/', trim($text))) {
            $text .= '.';
        }

        $match = preg_match_all("/.*?$needle/",$text, $matches);
        $frases = current($matches);

        return $frases;
    }
}

