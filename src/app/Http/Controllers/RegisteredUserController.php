<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisteredUserController extends Controller
{
    public function create(Request $request)
    {
        return view('register');
    }

    public function store(RegisterRequest $request)
    {
        $register = $request->only(['name', 'email', 'password']);
         $register['password'] = Hash::make($register['password']);
         $existingUser = User::where('email', $register['email'])->first();
         if ($existingUser) {
            return redirect()->back()->withInput()->withErrors(['email' => 'このメールアドレスは既に登録されています。']);
         }
        User::create($register);
        return view('login', compact('register'));
    }
}
