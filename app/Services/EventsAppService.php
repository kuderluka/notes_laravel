<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;

class EventsAppService {
    /**
     * Makes sure that a newly registered user is also registered in Kristjan's app and gets the token
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function register() {
        $client = new Client();
        $user = auth()->user();
        $boundary = uniqid();

        try {
            $response = $client->request('POST', 'http://localhost:8001/api/register', [
                'headers' => [
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                    'Accept' => 'application/json',
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'name',
                        'contents' => $user->username,
                    ],
                    [
                        'name' => 'email',
                        'contents' => $user->email,
                    ],
                    [
                        'name' => 'password',
                        'contents' => $user->password,
                    ],
                ], $boundary)
            ]);

            session(['events-token' => json_decode($response->getBody(), true)['token']]);
            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }

    /**
     * Contacts Kristjan's app on login to get the token
     *
     * @param $user
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function login($user) {
        $client = new Client();
        $boundary = uniqid();

        try {
            $response = $client->request('POST', 'http://localhost:8001/api/login', [
                'headers' => [
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                    'Accept' => 'application/json',
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'email',
                        'contents' => $user->email,
                    ],
                    [
                        'name' => 'password',
                        'contents' => $user->password,
                    ],
                ], $boundary)
            ]);

            session(['events-token' => json_decode($response->getBody(), true)['token']]);
            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }

    /**
     * Makes sure the tokens on Kristjan's side are deleted when the user logs out
     *
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function logout() {
        $client = new Client();

        try {
            $response = $client->request('POST', 'http://localhost:8001/api/logout', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                ]
            ]);

            return true;
        } catch(\Exception $exception) {
            return false;
        }
    }
}
