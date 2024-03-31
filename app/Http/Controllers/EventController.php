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
        return view('events', [
            'events' => $this->eventsAppService->getEvents($request->search)
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
        return view('user-show', [
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
}

