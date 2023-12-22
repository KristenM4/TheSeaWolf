<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function signup() {
        return view('accounts/signup');
    }
    public function signupSuccess(Request $request) {
        $signupFormData = $request->validate([]);
        return view('accounts/signupSuccess');
    }
}
