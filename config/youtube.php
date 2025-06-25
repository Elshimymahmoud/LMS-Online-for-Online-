<?php
return [
    'active' => 1,
    'token' => env('YT_DOWNLOADER_TOKEN_SK',''),
    'base_url' => env('YT_DOWNLOADER_BASE_URL','https://better-youtube-api.p.rapidapi.com'),
    'host' => env('YT_DOWNLOADER_HOST','better-youtube-api.p.rapidapi.com'),
    'settings' => array(
        'http.ConnectionTimeOut' => 30,
        'log.LogEnabled' => true,
        'log.FileName' => storage_path() . '/logs/youtube.log',
        'log.LogLevel' => 'ERROR'
    ),
];