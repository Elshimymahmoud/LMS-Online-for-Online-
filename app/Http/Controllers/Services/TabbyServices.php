<?php

namespace App\Http\Controllers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class TabbyServices
{
    private $client;
    private $base_url;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->base_url = config('tabby.base_url');
    }
    // https://api.tabby.ai/api/v2/checkout
    public function sendPayment($data)
    {
        try {
            $response = $this->client->request('POST', $this->base_url . '/checkout', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . config('tabby.public')
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