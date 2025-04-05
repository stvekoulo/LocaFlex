<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'unique:'.User::class],
            'phone' => 'required|regex:/^\+22901\d{8}$/',
            'role' => ['required', Rule::in(['Client', 'Loueur'])],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.lowercase' => 'L\'adresse e-mail doit être en minuscules.',
            'email.email' => 'L\'adresse e-mail doit être valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'phone.regex' => 'Le numéro de téléphone doit commencer par +229 01 suivi de 8 chiffres.',
            'role.required' => 'Le rôle est obligatoire.',
            'role.in' => 'Le rôle doit être soit Client, soit Loueur.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'Client') {
            return redirect()->route('home');
        } elseif ($user->role === 'Loueur') {
            return redirect('/loueur');
        };
    }
}
