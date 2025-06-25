<?php

namespace App\Http\Controllers\Services;

use App\Models\Auth\User;
use GuzzleHttp\Exception\ClientException;

class SmsServices
{
    private $client;
    private $base_url;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'base_uri' => config('sms.base_url'),
            'timeout'  => 300, // Increase the timeout to 300 seconds
        ]);
        $this->base_url = config('sms.base_url');
    }

    public function send(User $user, $msg)
    {
        try {
            $response = $this->client->request('GET', '/SendSMS', [
                'query' => [
                    'api_id' => config('sms.token'),
                    'api_password' => config('sms.password'),
                    'sms_type' => 'T',
                    'encoding' => 'U',
                    'sender_id' => 'IvoryTR',
                    'phonenumber' => $user->phone,
                    'textmessage' => $msg,
                    'uid' => 'xyz',
                    'templateid' => 2379,
                    'V1' => $msg
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