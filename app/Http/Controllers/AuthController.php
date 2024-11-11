<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|max:255'
        ]);

        $credentials = $request->only('email','password');
        $remember = $request->filled('remember');

        if(Auth::attempt($credentials,$remember)){
            return redirect()->intended('/');
        } else{
            return redirect()->back()
                ->with('error','Invalid Credentials');
        }
    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
