<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        try {
            $remember = $request->has('remember');
            if (Auth::attempt($credentials, $remember)):
                return redirect()->intended('dashboard')->with("success", "User logged in successfully");
            endif;
            return redirect()->back()->with("error", "The provided credentials do not match with our records.")->withInput($request->all());
        } catch (Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput($request->all());
        }
    }
}
