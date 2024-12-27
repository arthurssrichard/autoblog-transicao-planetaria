<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class GroqService
{
    protected $apiUrl = 'https://api.groq.com/openai/v1/chat/completions';

    private $client;

    public function __construct() {
        $this->client = new Client();
    }

    public function message($content, $role = 'user'){
        $apiKey = config('services.groq.api_key');
        $body = [
            'messages' => [
                [
                    'role' => $role,
                    'content' => $content,
                ],
            ],
            'model' => 'llama3-8b-8192',
        ];

        $response = $this->client->post($this->apiUrl,[
            'headers'=>[
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => $body,
        ]);

        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'];
    }

    public function promptedMessage($prompt, $content){
        $apiKey = config('services.groq.api_key');
        $body = [
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $prompt,
                ],
                [
                    'role' => 'user',
                    'content' => $content,
                ],
            ],
            'model' => 'llama3-8b-8192',
        ];

        $response = $this->client->post($this->apiUrl,[
            'headers'=>[
                'Authorization' => "Bearer $apiKey",
                'Content-Type' => 'application/json',
            ],
            'json' => $body,
        ]);

        
        $data = json_decode($response->getBody(), true);
        return $data['choices'][0]['message']['content'];
    }
}