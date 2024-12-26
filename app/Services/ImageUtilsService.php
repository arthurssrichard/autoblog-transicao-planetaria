<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Http\UploadedFile;

class ImageUtilsService{
    public function generateEditedImage($imageSource, $title)
    {
    
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
            $imageData = file_get_contents($imageSource);
        } else {
            throw new \Exception("Fonte de imagem inválida.");
        }
    
        // Lê e manipula a imagem
        $image = $manager->read($imageData);
    
        // Ajusta o brilho da imagem (opcional)
        //$image->brightness(-30);
    
        // Redimensiona a imagem
        $image->cover(1080 / 2, 1350 / 2);
    
        // Caminho para o overlay
        $overlayPath = public_path('storage/uploads/images/shadow_overlay.png');
        if (file_exists($overlayPath)) {
            $image->place($overlayPath, 'bottom-right', 0, 0, 100);
        }
    
        // Adiciona texto à imagem
        $image->text($title, 270, 500, function ($font) {
            $font->filename(public_path('storage/fonts/Quicksand-Regular.ttf'));
            $font->size(36); // Tamanho da fonte
            $font->color('#ffffff'); // Cor do texto (branco)
            $font->align('center'); // Alinhamento horizontal
            $font->valign('middle'); // Alinhamento vertical
            $font->angle(0); // Ângulo do texto
        });
    
        // Gera a imagem como uma string binária no formato JPEG
        $imageBinary = (string) $image->toJpeg(80);
    
        // Converte a string binária em Base64
        $imageBase64 = 'data:image/jpeg;base64,' . base64_encode($imageBinary);
    
        // Atualiza a propriedade Livewire com a imagem codificada
        return $imageBase64;
    }

}