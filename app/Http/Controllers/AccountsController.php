<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Cart;

class AccountsController extends Controller
{
    public function userProfile() {
        return view('accounts/user-profile');
    }

    public function login(Request $request) {
        if(auth()->check()) {
            return redirect('/');
        }
        $loginFormData = $request->validate([
            'email-login' => 'required',
            'password-login' => 'required'
        ]);
        if(auth()->attempt(['email'=>$loginFormData['email-login'], 'password'=>$loginFormData['password-login']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have successfully logged in.');
        }
        else {
            return redirect('/')->with('error', 'Incorrect email or password.');
        }
    }

    public function logout() {
        auth()->logout();
        return redirect('/')->with('success', 'You are now logged out.');
    }

    public function signup() {
        return view('accounts/signup');
    }
    public function signupSuccess(Request $request) {
        if(auth()->check()) {
            return redirect('/');
        }
        $signupFormData = $request->validate([
            'first_name' => ['required', 'min:2', 'max:50'],
            'last_name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'min:3', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6', 'max:30', 'confirmed']
        ]);
        $signupFormData['password'] = bcrypt($signupFormData['password']);
        $signupFormData['staff'] = false;

        $newUser = User::create($signupFormData);
        if (session('cartItems')) {
            foreach(session('cartItems') as $item) {
                Cart::create(['user_id' => $newUser->id, 'product_id' => $item['product']->id, 'quantity' => $item['quantity']]);
            }
        }
        auth()->login($newUser);

        return redirect('/')->with('success', 'Your account has successfully been created.');
    }

    public function editUser() {
        return view('accounts/edit-user');
    }

    public function saveNewDetails(Request $request) {
        $editUserFormData = $request->validate([
            'first_name' => ['required', 'min:2', 'max:50'],
            'last_name' => ['required', 'min:2', 'max:50'],
            'email' => ['required', 'email', 'min:3', 'max:50', Rule::unique('users')->ignore(auth()->user()->id),],
        ]);
        $editUserFormData['first_name'] = strip_tags($editUserFormData['first_name']);
        $editUserFormData['last_name'] = strip_tags($editUserFormData['last_name']);
        $editUserFormData['email'] = strip_tags($editUserFormData['email']);
        auth()->user()->update($editUserFormData);

        return back()->with('success', 'User details successfully changed.');
    }
}
