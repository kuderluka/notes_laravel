<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\EventsAppService;
use Dotenv\Repository\Adapter\ReplacingWriter;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use mysql_xdevapi\Exception;

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

        $this->eventsAppService->login($user);

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
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $this->eventsAppService->logout();

            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json([
                'message' => 'User logged out!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => false,
                'data' => $e
            ]);
        }
    }
}
