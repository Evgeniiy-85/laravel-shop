<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller {

    public function login() {
        if (Auth::check()) {
            return redirect()->route('catalog');
        }

        return view('auth.login');
    }

    public function auth(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attemptWhen([
            'user_email' => $request->email,
            'password' => $request->password,
            'user_status' => User::STATUS_ACTIVE,
        ])) {
            return redirect()->route('home');
        }

        return back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();

        return back();
    }
}
