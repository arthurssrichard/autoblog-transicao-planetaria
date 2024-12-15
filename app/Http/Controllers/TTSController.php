<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\GoogleTextToSpeechService;

class TTSController extends Controller
{
    private $ttsService;

    public function __construct()
    {
        $this->ttsService = new GoogleTextToSpeechService();
    }

    public function synthesize(String $content, String $slug)
    {
        $content = strip_tags($content); // Remove tags HTML para evitar problemas

        try {
            // Chama o serviço para gerar o áudio
            $audioContent = $this->ttsService->synthesize($content);

            // Salva o áudio em um arquivo
            $fileName = 'audio_' . $slug . time() . '.mp3';

            $filePath = 'audios/' . $fileName;
            
            Storage::disk('public')->put($filePath, base64_decode($audioContent));
            return $filePath;
        } catch (\Exception $e) {
            return false;
        }
    }
}
