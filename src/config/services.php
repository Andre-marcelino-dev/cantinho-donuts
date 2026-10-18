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
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // Dados da loja mostrados no site (página Contato, rodapé, mapa e "Faça seu pedido")
    'loja' => [
        'whatsapp' => env('LOJA_WHATSAPP', '5511988161211'), // só números, com 55 e DDD
        'app_url'  => env('LOJA_APP_URL', 'https://thegust-app.expo.app'),
        'email'    => env('LOJA_EMAIL', 'contato_confeitaria@ctrlaltdev.tipi5.smpsistema.com.br'),
        'endereco' => env('LOJA_ENDERECO', 'Rua Augusto Fiordelice, 310'),
        'bairro'   => env('LOJA_BAIRRO', 'Parque Santa Rita - Itaim Paulista'),
        'cidade'   => env('LOJA_CIDADE', 'São Paulo - SP'),
        'cep'      => env('LOJA_CEP', '08161-540'),
    ],

];
