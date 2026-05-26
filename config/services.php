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
'kodik' => [
        'base_url' => env('KODIK_BASE_URL', 'https://kodikapi.com'),
        'token'    => env('KODIK_API_TOKEN', ''),
        'hide_ads' => env('KODIK_HIDE_ADS', false),
    ],

    'anilibria' => [
        'base_url' => env('ANILIBRIA_BASE_URL', 'https://anilibria.top/api/v1'),
        'cdn_url'  => env('ANILIBRIA_CDN_URL', 'https://cache-rfn.libria.fun'),
    ],

];
