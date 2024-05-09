<?php

namespace App\Http\Controllers;

use auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class LoueurProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('profile_loueur.index')->with('user', $user);
    }

    public function updatePassword(Request $request)
    {
        $user = $user = auth()->user();

        $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'password_confirmation' => 'required|same:new_password',
                'new_password' => ['required', 'min:8', Rule::notIn([$request->current_password])],
            ],
            [
                'new_password.not_in' => 'Le nouveau mot de passe ne doit pas être identique à l\'ancien.',
            ],
        );

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()
                ->back()
                ->withErrors(['current_password' => 'Le mot de passe actuel fourni est incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Vous avez mis à jour votre mot de passe');
    }
}
