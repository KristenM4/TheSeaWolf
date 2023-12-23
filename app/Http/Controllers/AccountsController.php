<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AccountsController extends Controller
{
    public function signup() {
        return view('accounts/signup');
    }
    public function signupSuccess(Request $request) {
        $signupFormData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        User::create($signupFormData);

        return view('accounts/signupSuccess');
    }
}
