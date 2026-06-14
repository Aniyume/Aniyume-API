<?php

$csv = static fn (string $key, string $default = ''): array => array_values(array_filter(
    array_map('trim', explode(',', (string) env($key, $default)))
));

return [
    'tunnel_domains' => $csv('SECURITY_TUNNEL_DOMAINS', 'ngrok-free.app,ngrok.io,trycloudflare.com'),
    'tunnel_write_allowed_paths' => $csv(
        'SECURITY_TUNNEL_WRITE_ALLOWED_PATHS',
        'api/v1/auth/*,api/v1/profile/*,api/v1/watch-history*,api/v1/favorites*'
    ),
    'bad_user_agents' => $csv(
        'SECURITY_BAD_USER_AGENTS',
        'binlar,casper,checkprivilege,clshttp,cmsworldmap,diavol,dotbot,extract,feedfinder,flicky,g00g1e,harvest,heritrix,httrack,kmccrew,loader,miner,nikto,nutch,planetwork,purebot,pycurl,skygrid,sqlmap,sucker,turnit,vikspider,zmeu'
    ),
    'csp' => env(
        'SECURITY_CSP',
        "default-src 'self'; ".
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://unpkg.com https://cdn.tailwindcss.com; ".
        "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.tailwindcss.com; ".
        "font-src 'self' data: https://fonts.gstatic.com; ".
        "img-src 'self' data: https: http:; ".
        "connect-src 'self' http://localhost:* http://127.0.0.1:* ws://localhost:* ws://127.0.0.1:*; ".
        "frame-ancestors 'none';"
    ),
    'hsts_enabled' => env('SECURITY_HSTS_ENABLED'),

    'anti_scraper' => [
        'admin_fingerprints' => $csv('ANTI_SCRAPER_ADMIN_FINGERPRINTS'),
        'initial_trust_score' => (int) env('ANTI_SCRAPER_INITIAL_TRUST_SCORE', 100),
        'block_threshold' => (int) env('ANTI_SCRAPER_BLOCK_THRESHOLD', 20),
        'rate_limit_per_minute' => (int) env('ANTI_SCRAPER_RATE_LIMIT_PER_MINUTE', 100),
        'trust_ttl_days' => (int) env('ANTI_SCRAPER_TRUST_TTL_DAYS', 7),
        'block_delay_seconds' => (int) env('ANTI_SCRAPER_BLOCK_DELAY_SECONDS', 1),
        'expose_trust_score' => (bool) env('ANTI_SCRAPER_EXPOSE_TRUST_SCORE', false),
    ],
];
