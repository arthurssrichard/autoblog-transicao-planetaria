<?php

namespace App\Services;
use GuzzleHttp\Client;
use App\Services\SettingsService;

class InstagramService{

    private $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'https://graph.instagram.com/v21.0',
        ]);
    }

    public function createPostContainer(String $imageUrl, ?String $caption){
        $settings = new SettingsService;

        $userId = $settings->setting('instagram_user_id');
        $apiKey = $settings->setting('instagram_api_key');
        try{

            $response = $this->client->request('POST',$userId.'/media',[
                'query' => [
                    'image_url' => $imageUrl,
                    'caption' => $caption,
                    'access_token' => $apiKey,
                ],
            ]);

            $data = json_decode($response->getBody(), true);
            return $data;

        }catch(\Exception $e){
            echo "Ocorreu um erro ao preparar o post: " . $e->getMessage();
        }
    }



    public function publishPost($container){
        try {
            $containerId = $container['id'];
            $userId = config('services.instagram.test_user_id');
            $apiKey = config('services.instagram.access_token');
    
            $publishResponse = $this->client->request('POST', $userId . '/media_publish',[
                'query' => [
                    'creation_id' => $containerId,
                    'access_token' => $apiKey
                ],
            ]);
    
            $publishData = json_decode($publishResponse->getBody(), true);
    
        } catch (\Exception $e) {
            echo "Ocorreu um erro ao publicar o post: ". $e->getMessage();
        }
    }
}