<?php

namespace App\Http\Controllers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Utils;

class OcrServices
{
    private $client;
    private $base_url;

    public function __construct(Client $client)
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => config('ocr.base_url'),
            'timeout'  => 300, // Increase the timeout to 300 seconds
        ]);
        $this->base_url = config('ocr.base_url');
    }

    public function extract($data)
    {
        try {
            $multipartData = [];

            foreach ($data as $key => $value) {
                if ($key === 'file') {
                    $multipartData[] = [
                        'name' => $key,
                        'contents' => Utils::tryFopen($value->getPathname(), 'r'),
                        'filename' => $value->getClientOriginalName(),
                        'headers'  => [
                            'Content-Type' => $value->getMimeType()
                        ]
                    ];
                } else {
                    $multipartData[] = [
                        'name' => $key,
                        'contents' => $value
                    ];
                }
            }

            $response = $this->client->request('POST', $this->base_url . '/image', [
                'headers' => [
                    'apikey' => config('ocr.token'),
                ],
                'multipart' => $multipartData
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