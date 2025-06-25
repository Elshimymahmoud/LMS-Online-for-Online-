<?php

namespace App\Http\Controllers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class YouTubeServices
{
    private $client;
    private $base_url;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => config('youtube.base_url'),
            'timeout'  => 300, // Increase the timeout to 300 seconds
        ]);
        $this->base_url = config('youtube.base_url');
    }

    public function get_transcript($video_id)
    {
        try {
            $response = $this->client->request('GET', '/video', [
                'headers' => [
                    'x-rapidapi-host' => config('youtube.host'),
                    'x-rapidapi-key' => config('youtube.token'),
                ],
                'query' => [
                    'videoId' => $video_id,
                ]
            ]);

            $body = $response->getBody();

            $result = json_decode($body->getContents(), true);

            return $result;

        } catch (ClientException $e) {
            // Handle exception
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}