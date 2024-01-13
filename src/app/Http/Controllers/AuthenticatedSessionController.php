<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthenticatedSessionController extends Controller
{
        public function create(Request $request)
    {
        return view('login');
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);
        $email = $credentials['email'];

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            $email = auth()->user()->email;
             return redirect()->intended('/stamp');
        }else{
            auth()->logout();
            return redirect('/login')->with('error', 'ログインに失敗しました。');
        }         
            
         }
         
    

    private function checkRegistrationMatch($email)
    {
        $user = User::where('email', $email)->first();
        return ($user !== null);
    }


    public function destroy(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
