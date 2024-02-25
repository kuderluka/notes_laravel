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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images', 'public');
        } else {
            $image = 'images/ProfilePic.jpg';
        }

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

        event(new Registered($user));

        Auth::login($user);

        $this->eventsAppService->register();

        return redirect(RouteServiceProvider::HOME);
    }
}
