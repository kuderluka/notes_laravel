<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\MultipartStream;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
    /**
     * Returns the default events view
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request) {
        return view('events', [
            'events' => $this->getEvents($request->search)
        ]);
    }

    /**
     * Returns the view of one specific event
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show($id) {
        return view('event-show', [
            'event' => $this->getOneEvent($id)
        ]);
    }

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

    /**
     * Fetches all viable events
     *
     * @param $keyword
     * @return \Exception|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getEvents($keyword) {
        $client = new Client();

        try {
            $response = $client->request('GET', 'http://localhost:8001/api/events', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'query' => [
                    'keyword' => $keyword,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch(\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Fetches one event
     *
     * @param $id
     * @return \Exception|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
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

    /**
     * Adds the currently authenticated user as an attendee of a given event
     *
     * @param Request $request
     * @return \Exception|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addAttendee(Request $request) {
        $client = new Client();
        $boundary = uniqid();
        $user = auth()->user();

        try {
            $response = $client->request('POST', 'http://localhost:8001/api/addAttendee', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'email',
                        'contents' => $user->email,
                    ],
                    [
                        'name' => 'event_id',
                        'contents' => $request->event_id,
                    ],
                ], $boundary)
            ]);

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch(\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Removes the currently authenticated user as an attendee of a given event
     *
     * @param Request $request
     * @return \Exception|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function removeAttendee(Request $request) {
        $client = new Client();
        $boundary = uniqid();
        $user = auth()->user();

        try {
            $response = $client->request('POST', 'http://localhost:8001/api/removeAttendee', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . session('events-token'),
                    'Content-Type' => 'multipart/form-data; boundary=' . $boundary,
                ],
                'body' => new MultipartStream([
                    [
                        'name' => 'email',
                        'contents' => $user->email,
                    ],
                    [
                        'name' => 'event_id',
                        'contents' => $request->event_id,
                    ],
                ], $boundary)
            ]);

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch(\Exception $exception) {
            return $exception;
        }
    }
}
