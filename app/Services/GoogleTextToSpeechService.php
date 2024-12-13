<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;

class GoogleTextToSpeechService
{
    protected $apiUrl = 'https://texttospeech.googleapis.com/v1/text:synthesize';

    public function synthesize($text, $languageCode = 'pt-BR', $voiceName = 'pt-BR-Standard-B', $audioEncoding = 'MP3'){
        $apiKey = config('services.google_text_to_speech.api_key');
        $response = Http::post("{$this->apiUrl}?key={$apiKey}",[
            'input' => ['text'=>$text],
            'voice' => [
                'languageCode' => $languageCode,
                'name' => $voiceName,
            ],
            'audioConfig' =>[
                'audioEncoding' => $audioEncoding,
            ],
        ]);

        if($response->successful()){
            return $response->json()['audioContent'];
        }
        throw new \Exception('Erro ao sintetizar texto: '. $response->body());
    }
}