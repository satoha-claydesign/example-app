<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\NewUserIntroduction;
use Illuminate\Contracts\Mail\Mailer;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
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
    public function store(Request $request, Mailer $mailer)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($newUser));

        Auth::login($newUser);

        // Send introduction email to all users (only if mail is configured)
        if (config('mail.username') && config('mail.password')) {
            try {
                $allUsers = User::get();
                foreach ($allUsers as $user) {
                    $mailer->to($user->email)->send(new NewUserIntroduction($user, $newUser));
                }
            } catch (\Exception $e) {
                // Log the error but don't fail registration
                \Log::error('Failed to send new user introduction email: ' . $e->getMessage());
            }
        }

        return redirect(RouteServiceProvider::HOME);
    }
}