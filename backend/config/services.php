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

    'environment' => [
        'env' => env('APP_ENV'),
        'url' => env('APP_URL'),
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'secret' => env('STRIPE_SECRET')
    ],
    'slack' => [
        'webhook' => env('LOG_SLACK_WEBHOOK_URL'),
        'membership' => env('SLACK_HOOK')
    ],

    'awsurl' => [
        'url' => env('AWS_URL')
    ],

    'facebook' => [
        'client_id'     => env('FACEBOOK_ID'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect'      => 'api/oauth/callback?provider=facebook',
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => '/api/oauth/callback?provider=google',
    ],

    'twitch' => [
        'client_id'     => env('TWITCH_ID'),
        'client_secret' => env('TWITCH_SECRET'),
        'redirect'      =>'api/oauth/callback?provider=twitch',
    ],

    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_CLIENT_SECRET'),
        'redirect' =>  'api/oauth/callback?provider=discord',
    ],

    'epic_game' => [
        'client_id' => env('EPIC_GAMES_CLIENT_ID'),
        'client_secret' => env('EPIC_GAMES_CLIENT_SECRET'),
        'redirect' =>  'https://api.epicgames.dev/epic/oauth/v1/token',
    ],

];
