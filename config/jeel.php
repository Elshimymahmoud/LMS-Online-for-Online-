<?php
return [
    'active' => 1,
    'secret_client' => env('JEEL_CLIENT_SK',''),
    'client_id' => env('JEEL_CLIENT_ID',''),
    'secret_test' => env('JEEL_CLIENT_TEST_SK',''),
    'client_test_id' => env('JEEL_CLIENT_TEST_ID',''),
    'base_url' => env('JEEL_BASE_URL','https://auth.jeel.co'),
    'api_base_url' => env('JEEL_API_BASE_URL','https://api.jeel.co'),
    'base_url_test' => env('JEEL_BASE_TEST_URL','https://auth.sandbox.jeel.co'),
    'api_base_url_test' => env('JEEL_API_BASE_TEST_URL','https://api.sandbox.jeel.co'),
    'entity_id' => env('JEEL_ENTITY_ID',''),
    'entity_id_test' => env('JEEL_ENTITY_ID_TEST',''),
    'merchant_code' => env('JEEL_MERCHANT_CODE',''),
    'settings' => array(
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/jeel.log',
        'log.LogLevel' => 'ERROR'
    ),
];