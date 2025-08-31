<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Render combined page with both tabs
   public function showLogin()
{
    return view('login', ['activeTab' => session('activeTab', 'login')]);
}
  
public function showRegister()
{
    return view('login', ['activeTab' => session('activeTab', 'signup')]);
}


    // POST: /login
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
           return redirect()->route('admin.dashboard');
        }

        return back()
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->withInput(['email' => $request->email])
            ->with('activeTab', 'login');
    }

    // POST: /register
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please sign in.');
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}
