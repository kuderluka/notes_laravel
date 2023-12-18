<?php

namespace App\Http\Controllers;

use App\Services\EventsApiClient;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;

class EventController extends Controller
{
    private $eventsApiClient;

    public function __construct(EventsApiClient $eventsApiClient)
    {
        $this->eventsApiClient = $eventsApiClient;
    }

    public function index(Request $request)
    {
        return view('events', [
            'events' => $this->eventsApiClient->getEvents($request->search)
        ]);
    }

    public function show($id)
    {
        return view('event-show', [
            'event' => $this->eventsApiClient->getOneEvent($id)
        ]);
    }

    public function addAttendee(Request $request)
    {
        try {
            $this->eventsApiClient->addAttendee(
                auth()->user()->email,
                $request->event_id,
            );

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch (GuzzleException $exception) {
            return $exception;
        }
    }

    public function removeAttendee(Request $request)
    {
        try {
            $this->eventsApiClient->removeAttendee(
                auth()->user()->email,
                $request->event_id
            );

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch (GuzzleException $exception) {
            return $exception;
        }
    }
}

