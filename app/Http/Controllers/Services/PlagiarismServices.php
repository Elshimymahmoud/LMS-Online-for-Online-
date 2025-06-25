<?php

namespace App\Http\Controllers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class PlagiarismServices
{
    private $client;
    private $base_url;

    public function __construct(Client $client)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => config('youtube.base_url'),
            'timeout'  => 300, // Increase the timeout to 300 seconds
        ]);
        $this->base_url = config('plagiarism.base_url');
    }

    public function checkPlagiarism($data)
    {
        try {
            $response = $this->client->request('POST', $this->base_url . '/plagiarism', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-rapidapi-host' => config('plagiarism.host'),
                    'x-rapidapi-key' => config('plagiarism.token'),
                ],
                'json' => $data
            ]);

            $body = $response->getBody();
//            dd($body);
            $result = json_decode($body->getContents(), true);


            return $result;

        } catch (ClientException $e) {
            // Handle exception
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}