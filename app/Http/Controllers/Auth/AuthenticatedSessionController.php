<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\EventsAppService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Nette\Utils\Random;

class AuthenticatedSessionController extends Controller
{
    protected $eventsAppService;

    public function __construct(EventsAppService $eventsAppService)
    {
        $this->eventsAppService = $eventsAppService;
    }
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'Invalid credentials',
                'data' => false
            ]);
        }

        $user = Auth::user();

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    /**
     * Handles user authentication for socials
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticateSocials(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            $user = User::create([
                'id' => (string) Str::orderedUuid(),
                'username' => $request->name,
                'email' => $request->email,
                'password' => Hash::make(Random::generate(20)),
                'image' => $request->picture
            ]);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'message' => 'Success',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                'message' => 'User logged out!',
                'data' => auth()->user()->tokens()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => false,
                'data' => $e
            ]);
        }
    }
}
