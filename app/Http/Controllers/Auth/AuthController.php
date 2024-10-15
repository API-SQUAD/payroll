<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() : View
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request) : JsonResponse
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'success',
                'toast' => 'Login successful',
                'resets' => 'all',
                'redirect' => route('dashboard')
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'toast' => 'The provided credentials do not match our records.',
            'resets' => 'all',
            'errors' => [
                'username' => ['The provided credentials do not match our records.']
            ]
        ]);
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}
