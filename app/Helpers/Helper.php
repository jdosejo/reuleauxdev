<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Helper
{
    public static function apiCall($endpoint, $method, $body = [], $accessToken = '') {
        // $base_url = url('/');
        $base_url = "http://localhost:8001"; // api server
        
        $header = [
            "Content-Type" => "application/json; charset=utf8",
            'Accept' => 'application/json'
        ];

        if ($accessToken != '') {
            $header['Authorization'] = 'Bearer ' . $accessToken;
        }

        $client = new Client([
            'base_uri' => $base_url, "headers" => $header,
            'defaults' => [
                'exceptions' => false
            ]
        ]);
        
        $request_body = ['form_params' => $body];

        try {
            $result = $client->request($method, $endpoint, $request_body);
            $result_body = $result->getBody();
            $response = json_decode($result_body->getContents());
            return $response;
        } catch (GuzzleException $error) {
            return $error->getCode();
        }
    }
}

