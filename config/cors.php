<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

   'supports_credentials' => false,

   'allowed_origins' => ['*'],
    'allowed_headers' => ['*'], // Biarkan '*' untuk menerima semua header
    'allowed_methods' => ['*'], // Biarkan '*' untuk menerima semua metode HTTP
    'exposed_headers' => [],
    'max_age' => 0,
    'hosts' => [],


];
