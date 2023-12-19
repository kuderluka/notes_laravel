<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;

class EventsAppService {

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

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
            $response = $this->client->request('GET', 'http://localhost:8001/api/events', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'keyword' => $keyword,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            dd($exception);
            return false;
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
            $response = $this->client->request('GET', 'http://localhost:8001/api/event/' . $id, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }
    }

    /**
     * Makes the api request that adds an attendee to a certain event
     *
     * @param string $email
     * @param string $event_id
     * @return bool
     * @throws GuzzleException
     */
    public function addAttendee(string $email, string $event_id)
    {
        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/events/' . $event_id . '/attendees', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'event_id' => $event_id,
                ]
            ]);

            return true;
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }
    }

    /**
     * Makes the api request that removes an attendee from a certain event
     *
     * @param string $email
     * @param string $event_id
     * @return bool
     * @throws GuzzleException
     */
    public function removeAttendee(string $email, string $event_id)
    {
        try {
            $response = $this->client->request('DELETE', 'http://localhost:8001/api/events/' . $event_id . '/attendees/' . $email, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    'email' => $email,
                    'event_id' => $event_id,
                ]
            ]);

            return true;
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }
    }

    /**
     * Makes sure that a newly registered user is also registered in Kristjan's app and gets the token
     *
     * @return bool
     */
    public function register() {
        $user = auth()->user();

        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/register', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'name' => $user->username,
                    'email' => $user->email,
                    'password' => $user->password,
                ]
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
    public function login($user) {
        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/login', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'email' => $user->email,
                    'password' => $user->password,
                ]
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
    public function logout() {
        try {
            $response = $this->client->request('POST', 'http://localhost:8001/api/logout', [
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
