<?php

namespace App\Services;
use GuzzleHttp\Client;

class ImgbbService{
    private $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://api.imgbb.com/1/upload',
        ]);
    }

    public function uploadImage($image){
        $apiKey = config('services.imgbb.api_key');

        try{
            $response = $this->client->request('POST', '', [
                'query' =>[
                    'key' => $apiKey,
                ],
                'form_params' => [
                    'image' => $image,
                    'expiration' => 60
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            return $data['data']['url'];
        }catch(\Exception $e){
            echo "Erro ao subir para imgbb: " . $e;
        }
    }

}