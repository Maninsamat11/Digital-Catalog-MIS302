<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function createAdmin()
    {
        return view('auth.admin-login');
    }

   // App\Http\Controllers\Auth\AuthenticatedSessionController.php

public function store(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
    $request->session()->regenerate();

    if (Auth::user()->is_admin == 1) {
        // This matches the ->name('admin.dashboard') in your web.php
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home');
}

    return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
}

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}