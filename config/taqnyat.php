<?php
return [
    'active' => 1,
    'token' => env('TAQNYAT_SMS_TOKEN',''),
    'base_url' => env('TAQNYAT_BASE_URL','https://api.taqnyat.sa'),
    'settings' => array(
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/taqnyat.log',
        'log.LogLevel' => 'ERROR'
    ),
];