<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EventController;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\EventsAppService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $eventsAppService;

    public function __construct(EventsAppService $eventsAppService)
    {
        $this->eventsAppService = $eventsAppService;
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $errors = [];
        $existingUser = User::where('username', $request->username)->first();
        if ($existingUser) {
            $errors['username'] = 'Username already taken!';
        }

        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            $errors['email'] = 'Email already taken!';
        }

        if ($request->password !== $request->password_confirmation) {
            $errors['password'] = "Passwords don't match!";
        }

        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed!',
                'data' => [
                    'errors' => $errors
                ],
            ], 422);
        }

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'id' => (string) Str::orderedUuid(),
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $image
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration successful!',
            'data' => [
                'token' => $token,
                'user' => $user
            ]
        ]);
      
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials!',
                'data' => [
                    'error' => $e
                ]
            ], 422);
        }
    }
}
