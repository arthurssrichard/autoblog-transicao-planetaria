<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'google_text_to_speech' => [
        'api_key' => env('GOOGLE_TTS_API_KEY'),
    ],
    'pexels' => [
        'api_key' => env('PEXELS_API_KEY'),
    ],
    'groq' => [
        'api_key' => env('GROQ_API_KEY'),
    ],
    'instagram' => [
        'access_token' => env('INSTAGRAM_GRAPH_API_KEY'),
        'user_id' => env('GRAPH_API_TRANSICAOPLANETARIA_USER_ID'),
        'test_user_id' => env('GRAPH_API_ARTHURRICHARDMOTION_USER_ID')
    ],
    'imgbb' => [
        'api_key' => env('IMGBB_API_KEY'),
    ]

];
