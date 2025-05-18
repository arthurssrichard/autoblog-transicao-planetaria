<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUtilsService{
    public function generateEditedImage($imageSource, $title)
    {
        $title = $this->quebraStringEmLinhas($title, 20);
        // Cria o gerenciador de imagens com o driver escolhido
        $manager = new ImageManager(new Driver());
    
        // Variável para armazenar os dados binários da imagem
        $imageData = null;
    
        // Verifica o tipo de fonte de imagem
        if ($imageSource instanceof UploadedFile) {
            // Para arquivos enviados, obtemos o caminho real
            $imageData = file_get_contents($imageSource->getRealPath());
        } elseif (filter_var($imageSource, FILTER_VALIDATE_URL)) {

            // Para URLs válidas (como Pexels), baixamos o conteúdo
            $tempPath = sys_get_temp_dir() . '/temp_image.jpg';
            file_put_contents($tempPath, file_get_contents($imageSource));
            $imageData = $tempPath;

            //dd($imageSource);
            //dd($imageData);
        } else {
            throw new \Exception("Fonte de imagem inválida.");
        }
    
        // Lê e manipula a imagem
        $image = $manager->read($imageData);

    
        // Ajusta o brilho da imagem (opcional)
        //$image->brightness(-30);
    
        // Redimensiona a imagem
        $image->cover(600, 600);

        // Caminho para o overlay
        $overlayPath = public_path('assets/images/shadow_overlay.png');
        if (file_exists($overlayPath)) {
            $image->place($overlayPath, 'bottom-right', 0, 0, 100);
        }
    
        // Adiciona texto à imagem
        $image->text($title, 300, 440, function ($font) {
            $font->filename(public_path('assets/fonts/Quicksand-Regular.ttf'));
            $font->size(40); // Tamanho da fonte
            $font->color('#ffffff'); // Cor do texto (branco)
            $font->align('center'); // Alinhamento horizontal
            $font->valign('middle'); // Alinhamento vertical
            $font->angle(0); // Ângulo do texto
        });
    
        // Gera a imagem como uma string binária no formato JPEG
        $imageBinary = $image->toJpeg(80);
    
        // Converte a string binária em Base64
        //$imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageBinary);
        $imageBase64 = base64_encode($imageBinary);
    
        // Atualiza a propriedade Livewire com a imagem codificada
        return $imageBase64;
    }

    function quebraStringEmLinhas($string, $limite) {
        // Remove espaços extras
        $string = trim($string);
    
        // Divide a string em palavras
        $palavras = explode(' ', $string);
    
        $linhas = [];
        $linhaAtual = '';
    
        foreach ($palavras as $palavra) {
            // Verifica se adicionar a palavra ultrapassa o limite
            if (strlen($linhaAtual . ' ' . $palavra) > $limite) {
                // Adiciona a linha atual ao array de linhas
                $linhas[] = trim($linhaAtual);
                // Reinicia a linha atual com a palavra
                $linhaAtual = $palavra;
            } else {
                // Adiciona a palavra à linha atual
                $linhaAtual .= ' ' . $palavra;
            }
        }
    
        // Adiciona a última linha ao array de linhas, se houver conteúdo
        if (!empty($linhaAtual)) {
            $linhas[] = trim($linhaAtual);
        }
    
        // Retorna as linhas unidas por quebras de linha
        return implode("\n", $linhas);
    }

    function storeTemporaryBase64Image($base64Image)
    {
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));
        $filename = Str::uuid() . '.jpg';
        $path = "temp/{$filename}";

        Storage::disk('public')->put($path, $imageData);

        // Mantém o cache da imagem por 30 segundos (controle de validade)
        cache()->put("temp_image:{$filename}", true, now()->addSeconds(30));

        return url("storage/temp/{$filename}");
    }
    
}