<?php
return [
    'active' => 1,
    'token' => env('SMS_TOKEN',''),
    'base_url' => env('SMS_BASE_URL','http://REST.GATEWAY.SA/api'),
    'password' => env('SMS_PASS',''),
    'settings' => array(
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/youtube.log',
        'log.LogLevel' => 'ERROR'
    ),
];