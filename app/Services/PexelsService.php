<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PexelsService
{
    protected $apiUrl = 'https://api.pexels.com/v1/search';
    private $client;
    public function __construct() {
        $this->client = new Client();
    }

    public function photos($query = 'horizon',$perPage = 4){
        $apiKey = config('services.pexels.api_key');
        $response = $this->client->request('GET',$this->apiUrl,[
            'headers' =>[
                'Authorization' => $apiKey,
            ],
            'query' => [
                'query' => $query,
                'per_page' => $perPage,
            ],
        ]);
        $data = json_decode($response->getBody(), true);
        return $data;
    }
}