<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Exception\GuzzleException;

class EventsApiClient
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getEvents($keyword)
    {
        try {
            $response = $this->client->request('GET', 'http://localhost:8001/api/events', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'keyword' => $keyword,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            throw $exception;
        }
    }

    public function getOneEvent($id)
    {
        try {
            $response = $this->client->request('GET', 'http://localhost:8001/api/event/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            throw $exception;
        }
    }

    public function addAttendee($email, $event_id)
    {
        $boundary = uniqid();

        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/addAttendee', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'email',
                        'contents' => $email,
                    ],
                    [
                        'name' => 'event_id',
                        'contents' => $event_id,
                    ],
                ], $boundary)
            ]);

            return true;
        } catch (GuzzleException $exception) {
            throw $exception;
        }
    }

    public function removeAttendee($email, $event_id)
    {
        $boundary = uniqid();

        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/removeAttendee', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'email',
                        'contents' => $email,
                    ],
                    [
                        'name' => 'event_id',
                        'contents' => $event_id,
                    ],
                ], $boundary)
            ]);

            return true;
        } catch (GuzzleException $exception) {
            throw $exception;
        }
    }
}

