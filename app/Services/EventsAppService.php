<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;

class EventsAppService {

    /**
     * Constructor that injects the client
     *
     * @param Client $client
     */
    public function __construct(protected Client $client){}

    /**
     * Fetches all events
     *
     * @param $keyword
     * @return false|mixed
     * @throws GuzzleException
     */
    public function getEvents($keyword)
    {
        try {
            $response = $this->client->request('GET', config('events.url') . '/api/events', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'keyword' => $keyword,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Fetches more specific data of one event
     *
     * @param $id
     * @return false|mixed
     * @throws GuzzleException
     */
    public function getOneEvent($id)
    {
        try {
            $response = $this->client->request('GET', config('events.url') . '/api/events/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            dd($exception);
            return $exception;
        }
    }

    /**
     * Returns all the events that a certain user is attending
     *
     * @param $id
     * @return false|mixed
     * @throws GuzzleException
     */
    public function getUsersEvents($email)
    {
        try {
            $response = $this->client->request('GET', config('events.url') . '/api/attending/' . $email, [
                'headers' => [
                    'Accept' => 'application/json',
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}
