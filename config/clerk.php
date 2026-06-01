<?php

return [
    'issuer' => env('CLERK_ISSUER'),
    'jwks_url' => env('CLERK_JWKS_URL'),
    'authorized_parties' => array_values(array_filter(array_map('trim', explode(',', env('CLERK_AUTHORIZED_PARTIES', ''))))),
    'admin_emails' => array_values(array_filter(array_map('strtolower', array_map('trim', explode(',', env('CLERK_ADMIN_EMAILS', '')))))),
];
