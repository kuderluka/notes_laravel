<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\EventsAppService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use GuzzleHttp\Exception\GuzzleException;

class EventController extends Controller
{
    /**
     * Constructor that injects the EventsAppService
     *
     * @param EventsAppService $eventsAppService
     */
    public function __construct(protected EventsAppService $eventsAppService){}

    /**
     * Returns the view of all events
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'Success',
            'data' => [
                'events' => $this->eventsAppService->getEvents($request->search)
            ]
        ]);
    }

    /**
     * Gets the data of a single user
     *
     * @param User $user
     * @return JsonResponse
     */
    public function getSingleUsersData(User $user)
    {
        return response()->json([
            'user' => $user,
            'notes' => $user->notes()->with('user')->with('category')->get()
        ]);
    }

    /**
     * Returns the view of a certain user's profile
     *
     * @param User $user
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function userEvents(User $user)
    {
        return response()->json([
            'user' => $user,
            'notes' => $user->notes()->where('public', 1)->with('user', 'category')->get(),
            'events' => $this->getUsersEvents($user->email)
        ]);
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
        return $this->eventsAppService->getUsersEvents($email);
    }

    /**
     * Adds the currently authenticated user to the list of attendees of a certain event
     *
     * @param Request $request
     * @return \Exception|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addAttendee(Request $request)
    {
        try {
            $this->eventsAppService->addAttendee(
                auth()->user()->email,
                $request->event_id,
            );

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch (\Exception $exception) {
            return $exception;
        }
    }

    /**
     * Removes the currently authenticated user from the list of attendees of a certain event
     *
     * @param Request $request
     * @return \Exception|GuzzleException|\Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function removeAttendee(Request $request)
    {
        try {
            $this->eventsAppService->removeAttendee(
                auth()->user()->email,
                $request->event_id
            );

            return redirect(route('event.show', ['event' => $request->event_id]));
        } catch (\Exception $exception) {
            return $exception;
        }
    }
}

