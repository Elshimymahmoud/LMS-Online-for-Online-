<?php

namespace App\Http\Controllers\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class JeelPayServices
{
    private $client;
    private $base_url;
    private $api_base_url;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->base_url = config('jeel.base_url');
        $this->api_base_url = config('jeel.api_base_url');
    }

    /**
     * Get Token
     * @return array|mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken()
    {
        try {
            $response = $this->client->request('POST', $this->base_url . '/oauth2/token', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'client_id' => config('jeel.client_id'),
                    'client_secret' => config('jeel.secret_client'),
                    'grant_type' => 'client_credentials',
                ],
            ]);

            $body = $response->getBody();
            $result = json_decode($body->getContents(), true);

            return $result['access_token'] ?? null;

        } catch (ClientException $e) {
            // Handle exception
          


            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Send Checkout Request
     * @param $data
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendPayment($data)
    {

        // Get Token
        $token = $this->getToken();

        

        try {
            $response = $this->client->request('POST', $this->api_base_url . '/v2/installment-requests', [
                'headers' => [
                    'accept' => '/',
                    'User-Agent' => "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '. $token ,
                ],
                'json' => $data,
            ]);

            $body = $response->getBody();

            $result = json_decode($body->getContents(), true);


            return $result;

        } catch (ClientException $e) {
            // Handle exception
            error_log('Request Headers: ' . json_encode([
                    'accept' => '/',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ]));
            error_log('Request Payload: ' . json_encode($data));
            error_log('Error: ' . $e->getMessage());
            $message = $e->getMessage();

            // Get response
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);
            return ['status' => 'error', 'message' => $message, 'response' => $response];
        }
    }

    /**
     * Check User installment Eligibility
     * @param $data
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function checkEligibility($data)
    {
        // Get Token
        $token = $this->getToken();

        // dd();

        try {
            $response = $this->client->request('POST', $this->api_base_url . '/v1/installment-requests/cost-calculation', [
                'headers' => [
                    'accept' => '/',
                    'User-Agent' => "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36",
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ],
                'json' => $data,
            ]);

            $body = $response->getBody();

            $result = json_decode($body->getContents(), true);


            return $result;

        } catch (ClientException $e) {
            // Handle exception
            error_log('Request Headers: ' . json_encode(['accept' => '/', 'Content-Type' => 'application/json', 'Authorization' => 'Bearer ' . $token,]));
            error_log('Request Payload: ' . json_encode($data));
            error_log('Error: ' . $e->getMessage());
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

}