<?php
return [
    'active' => 1,
    'secret' => env('TABBY_TOKEN_SK',''),
    'public' => env('TABBY_TOKEN_PK',''),
    'secret_test' => env('TABBY_TOKEN_TEST_SK',''),
    'public_test' => env('TABBY_TOKEN_TEST_PK',''),
    'base_url' => env('TABBY_BASE_URL','https://api.tabby.ai/api/v2'),
    'merchant_code' => env('TABBY_MERCHANT_CODE',''),
    'settings' => array(
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/tabby.log',
        'log.LogLevel' => 'ERROR'
    ),
];