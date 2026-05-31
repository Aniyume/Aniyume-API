<?php

return [
    'provider' => env('AI_PROVIDER', (env('AI_API_KEY') || env('DEEPSEEK_API_KEY')) ? 'deepseek' : 'stub'),
    'base_url' => env('AI_BASE_URL', env('DEEPSEEK_BASE_URL', 'https://api.deepseek.com')),
    'api_key' => env('AI_API_KEY') ?: env('DEEPSEEK_API_KEY'),
    'model' => env('AI_MODEL', env('DEEPSEEK_MODEL', 'deepseek-chat')),
    'timeout' => (int) env('AI_TIMEOUT', 30),
    'max_output_tokens' => (int) env('AI_MAX_OUTPUT_TOKENS', 1200),
    'temperature' => (float) env('AI_TEMPERATURE', 0.1),
    'thinking_mode' => (bool) env('AI_THINKING_MODE', false),
    'session_history_limit' => (int) env('AI_SESSION_HISTORY_LIMIT', 20),
    'session_retention_days' => (int) env('AI_SESSION_RETENTION_DAYS', 0),

    'rate_limits' => [
        'standard' => env('AI_RATE_LIMIT_STANDARD', 10),
        'premium' => env('AI_RATE_LIMIT_PREMIUM', 30),
        'admin' => env('AI_RATE_LIMIT_ADMIN', 60),
        'creator' => env('AI_RATE_LIMIT_CREATOR', 60),
    ],

    'tools' => [
        'anime.search' => [
            'roles' => ['standard', 'premium', 'admin', 'creator'],
            'description' => 'Search public anime catalog by title.',
        ],
        'user.anime_list' => [
            'roles' => ['standard', 'premium', 'admin', 'creator'],
            'description' => 'Read the current authenticated user anime list.',
        ],
        'user.profile_summary' => [
            'roles' => ['standard', 'premium', 'admin', 'creator'],
            'description' => 'Read a minimal current user profile summary.',
        ],
        'admin.dashboard_summary' => [
            'roles' => ['admin', 'creator'],
            'description' => 'Read a compact admin dashboard summary.',
        ],
    ],
];
