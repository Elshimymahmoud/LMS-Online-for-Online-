<?php
return [
    'active' => 1,
    'token' => env('PLAGIARISM_TOKEN_SK',''),
    'host' => env('PLAGIARISM_HOST',''),
    'base_url' => env('PLAGIARISM_BASE_URL','https://api.tabby.ai/api/v2'),
    'settings' => array(
        'http.ConnectionTimeOut' => 300,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/plagiarism.log',
        'log.LogLevel' => 'ERROR'
    ),
];