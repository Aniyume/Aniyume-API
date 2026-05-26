<?php

$allowedOrigins = array_values(array_filter(array_map('trim', explode(',', env(
    'CORS_ALLOWED_ORIGINS',
    implode(',', array_filter([
        'http://localhost',
        'http://localhost:3000',
        'http://localhost:5173',
        'http://127.0.0.1:3000',
        'http://127.0.0.1:5173',
        rtrim((string) config('app.url'), '/'),
    ]))
)))));

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => array_values(array_filter(array_map('trim', explode(',', env(
        'CORS_ALLOWED_METHODS',
        'GET,POST,PUT,PATCH,DELETE,OPTIONS'
    ))))),

    'allowed_origins' => $allowedOrigins,

    'allowed_origins_patterns' => array_values(array_filter(array_map('trim', explode(',', env(
        'CORS_ALLOWED_ORIGIN_PATTERNS',
        ''
    ))))),

    'allowed_headers' => array_values(array_filter(array_map('trim', explode(',', env(
        'CORS_ALLOWED_HEADERS',
        'Accept,Authorization,Content-Type,X-Requested-With,X-XSRF-TOKEN,X-Fingerprint-ID'
    ))))),

    'exposed_headers' => [],

    'max_age' => (int) env('CORS_MAX_AGE', 0),

    'supports_credentials' => (bool) env('CORS_SUPPORTS_CREDENTIALS', false),
];
