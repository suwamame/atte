<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
        public function create(Request $request)
    {
        return view('login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/stamp');}

             throw ValidationException::withMessages([
                'email' => ['ログインに失敗しました。'],
                'password' => ['ログインに失敗しました。'],
        ]);
    }

    public function destroy(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
