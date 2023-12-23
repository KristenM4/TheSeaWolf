<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;

class AccountsController extends Controller
{
    public function signup() {
        return view('accounts/signup');
    }
    public function signupSuccess(Request $request) {
        $signupFormData = $request->validate([
            'first_name' => ['required', 'min:2', 'max:50'],
            'last_name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'min:3', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30', 'confirmed']
        ]);
        $signupFormData['password'] = bcrypt($signupFormData['password']);

        User::create($signupFormData);

        return view('accounts/signupSuccess');
    }
}
