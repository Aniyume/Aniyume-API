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
        'token' => env('KODIK_API_TOKEN', ''),
        'hide_ads' => env('KODIK_HIDE_ADS', false),
    ],

    'anilibria' => [
        'base_url' => env('ANILIBRIA_BASE_URL', 'https://anilibria.top/api/v1'),
        'cdn_url' => env('ANILIBRIA_CDN_URL', 'https://cache-rfn.libria.fun'),
    ],

    'allanime' => [
        'enabled' => env('ALLANIME_ENABLED', false),
        'base_host' => env('ALLANIME_BASE_HOST', 'allanime.day'),
        'api_url' => env('ALLANIME_API_URL', 'https://api.allanime.day/api'),
        'referer' => env('ALLANIME_REFERER', 'https://youtu-chan.com'),
        'mode' => env('ALLANIME_MODE', 'sub'),
        'proxy_enabled' => env('ALLANIME_PROXY_ENABLED', true),
        'proxy_public_prefix' => env('ALLANIME_PROXY_PUBLIC_PREFIX', '/api/external/public'),
        'max_episodes_per_import' => env('ALLANIME_MAX_EPISODES_PER_IMPORT', 2000),
        'user_agent' => env('ALLANIME_USER_AGENT', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:150.0) Gecko/20100101 Firefox/150.0'),
    ],

    'tmdb' => [
        'key' => env('TMDB_API_KEY'),
        'token' => env('TMDB_BEARER_TOKEN'),
    ],

    'monitoring' => [
        'uptime' => [
            'url' => env('UPTIME_KUMA_INTERNAL_URL'),
            'health_path' => '/',
        ],
        'grafana' => [
            'url' => env('GRAFANA_INTERNAL_URL'),
            'health_path' => '/api/health',
        ],
        'nocodb' => [
            'url' => env('NOCODB_INTERNAL_URL'),
            'health_path' => '/',
        ],
        'understand-anything' => [
            'url' => env('UNDERSTAND_ANYTHING_INTERNAL_URL'),
            'health_path' => '/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Optional external iframe players
    |--------------------------------------------------------------------------
    |
    | These providers are disabled until a URL template is configured in .env.
    | Templates can use: {shikimori_id}, {title}, {title_en}, {year}, {anime_id}.
    | They are used as a last-resort fallback for players with built-in episode
    | selectors / rare no-name voiceovers.
    |
    */
    'external_players' => [
        'alloha' => [
            'template' => env('ALLOHA_PLAYER_URL_TEMPLATE'),
            'translator' => env('ALLOHA_TRANSLATOR', 'Alloha'),
        ],
        'collaps' => [
            'template' => env('COLLAPS_PLAYER_URL_TEMPLATE'),
            'translator' => env('COLLAPS_TRANSLATOR', 'Collaps'),
        ],
        'ashdi' => [
            'template' => env('ASHDI_PLAYER_URL_TEMPLATE'),
            'translator' => env('ASHDI_TRANSLATOR', 'Ashdi'),
        ],
        'vibix' => [
            'template' => env('VIBIX_PLAYER_URL_TEMPLATE'),
            'translator' => env('VIBIX_TRANSLATOR', 'Vibix'),
        ],
        'hdvb' => [
            'template' => env('HDVB_PLAYER_URL_TEMPLATE'),
            'translator' => env('HDVB_TRANSLATOR', 'HDVB'),
        ],
    ],

];
