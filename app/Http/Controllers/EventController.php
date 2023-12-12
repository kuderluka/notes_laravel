<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    public function index() {
        return view('events', [
            'events' => $this->getEvents()
        ]);
    }

    public function show($id) {
        return view('event-show', [
            'event' => $this->getOneEvent($id)
        ]);
    }

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

    public function getEvents() {
        $client = new Client();
        try {
            $response = $client->request('GET', 'http://localhost:8001/api/events', [
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch(\Exception $exception) {
            return $exception;
        }
    }

    public function getOneEvent($id) {
        $client = new Client();
        try {
            $response = $client->request('GET', 'http://localhost:8001/api/event/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch(\Exception $exception) {
            return $exception;
        }
    }
}
