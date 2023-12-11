<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
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
            var_dump(json_decode($response->getBody(), true)['token']);
            dd($response);
            return true;
        } catch(\Exception $exception) {
            dd($exception);
            return false;
        };
    }
}
