<?php
return [
    'active' => 1,
    'token' => env('OCR_TOKEN_SK',''),
    'base_url' => env('OCR_BASE_URL','https://api.tabby.ai/api/v2'),
    'settings' => array(
        'http.ConnectionTimeOut' => 300,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/ocr.log',
        'log.LogLevel' => 'ERROR'
    ),
];