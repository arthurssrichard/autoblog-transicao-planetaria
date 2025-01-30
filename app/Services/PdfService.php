<?php 

namespace App\Services;
use Smalot\PdfParser\Parser;
use App\Models\Book;
class PdfService
{
    /**
     * Realiza todo o processo de pegar uma mensagem a partir do título e retornar seu corpo formatado
     */
    function exibirMensagem(String $title, Book $book)
    {
        $index = $this->indice($book);
        $pdf = $this->pdf($book);

        // procurar páginas do livro no índice a partir do título
        $pages = $this->getPagesMessage($title, $index);

        $content = '';
        foreach ($pages as $page) {
            $content .= $pdf->getPages()[$page - 1]->getText();
        }

        $content = preg_replace("/([A-Z]+)\s\s\s([A-Z]+)/", "$1 $2", $content);
        $escapedTitle = mb_strtoupper($title);
        $escapedTitle = preg_replace('/\s+/', '\\s*', $escapedTitle);

        $pattern2 = "/($escapedTitle.*?)(?=\d+\.\s|$|\.{4,})/siu";
        if (preg_match($pattern2, $content, $matches)) {
            $rawMessage = $matches[1];
        }
        $formatedMessage = $this->formatarMensagem($rawMessage, $escapedTitle, $pages);

        return $formatedMessage;
    }


    /**
     * Recebe o texto bruto e retorna a imagem formatada, dividida em parágrafos,
     * com a ultima frase do texto em negrito, sem titulo e sem páginas
     */
    function formatarMensagem(String $mensagem, String $title, $pages){

        // retirar titulo
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


    /**
     * Retorna a página de capítulos bruta
     * @param $book - pdf parseado para texto
     * @return $index - texto contento todos os caracteres pertencentes ao índice do livro
     */
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


    /**
     * Recebe um o livro, encontra o seu pdf no storage e transforma em texto
     */
    function pdf(Book $book)
    {
        $parser = new Parser();
        $filePath = storage_path('app/public/' . $book->path);
        $pdf = $parser->parseFile($filePath);
        return $pdf;
    }


    // Retorna os capítulos bonitinhos (Usado no controller book)
    function capitulos(Book $book){
        $index = $this->indice($book);

        return $this->extractMessages($index);
    }


    /**
     * Retorna um vetor de titulos baseado no índice
     */
    function extractMessages($text)
    {
        // Define o padrão para capturar os títulos
        $pattern = '/\d+\.\s+(.*?)(?=\.\.\.| \d)/';

        // Aplica o regex
        preg_match_all($pattern, $text, $matches);

        // Retorna apenas o grupo capturado (os títulos)
        return $matches[1];
    }

    /**
     * Recebe a primeira e ultima palavra que compõe o índice, e "recorta" apenas os capítulos
     */
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


    /**
     * Deixa os espaçamentos do índice do livro homogeneos, para facilitar futuros
     * regex que forem utilizados no texto
     * @param $text - índice do livro
     * @return $text - texto processado
     */
    function normalizeIndex($text) {
        // Remove quebras de linha seguidas de espaços
        $text = preg_replace('/\n\s*/', ' ', $text);
    
        // Remove espaços extras
        $text = preg_replace('/\s+/', ' ', $text);
    
        // Retorna o índice normalizado
        return trim($text);
    }


    /**
     * Procurar páginas do livro no índice a partir do título
     */
    function getPagesMessage($title, $index){
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


    /**
     * Realiza todo o processo de pegar uma mensagem a partir do
     * título, pagina inicial e final e retornar seu corpo formatado
     */
    function exibirMensagemEspecifica(String $title, $pgInicial, $pgFinal, Book $book){
        $pdf = $this->pdf($book);

        $pages = range($pgInicial, $pgFinal);
        $content = '';
        foreach($pages as $page){
            $content .= $pdf->getPages()[$page-1]->getText();
        }

        $content = preg_replace("/([A-Z]+)\s\s\s([A-Z]+)/", "$1 $2",$content);
        $escapedTitle = mb_strtoupper($title);
        $escapedTitle = preg_replace('/\s+/','\\s*',$escapedTitle);

        $pattern2 = "/($escapedTitle.*?)(?=\d+\.\s|$|\.{4,})/siu";
        if(preg_match($pattern2,$content,$matches)){
            $rawMessage = $matches[1];
        }
        
        return $this->formatarMensagem($rawMessage, $escapedTitle, $pages);
    }
    

    /**
     * Quebra o texto em frases, para separar na formatação
     */
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

