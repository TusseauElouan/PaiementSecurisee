<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
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
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => [
                    'required',
                    'confirmed',
                    'string',
                    'min:10',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*#?&]/',
                ],
            ],
            [
                'name.required' => 'Le nom est obligatoire.',
                'name.string' => 'Le nom doit être une chaîne de caractères.',
                'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
                'email.required' => 'L\'adresse e-mail est obligatoire.',
                'email.string' => 'L\'adresse e-mail doit être une chaîne de caractères.',
                'email.lowercase' => 'L\'adresse e-mail doit être en minuscules.',
                'email.email' => 'L\'adresse e-mail doit être valide.',
                'email.max' => 'L\'adresse e-mail ne doit pas dépasser 255 caractères.',
                'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.confirmed' => 'Les mots de passe ne correspondent pas.',
                'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
                'password.min' => 'Le mot de passe doit contenir au moins 10 caractères.',
                'password.regex' => 'Le mot de passe doit contenir au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial (@, $, !, %, *, #, ?, &).',
            ]
        );



        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
