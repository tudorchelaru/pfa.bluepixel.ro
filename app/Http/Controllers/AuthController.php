<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'required' => 'Campul :attribute este obligatoriu.',
        ], [
            'username' => 'username',
            'password' => 'parola',
        ]);

        if ($validator->fails()) {
            Log::warning('Login validation failed', [
                'input_keys' => array_keys($request->all()),
                'has_username' => $request->has('username'),
                'has_password' => $request->has('password'),
                'username_len' => strlen((string) $request->input('username', '')),
                'password_len' => strlen((string) $request->input('password', '')),
                'ip' => $request->ip(),
            ]);

            return back()->withErrors($validator)->onlyInput('username');
        }

        $credentials = $validator->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $authUser = Auth::user();
            if ($authUser && !$authUser->is_approved) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'username' => 'Contul tău este în așteptare. Adminul trebuie să îl valideze.',
                ])->onlyInput('username');
            }

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username sau parolă incorectă.',
        ])->onlyInput('username');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:64|unique:users,username',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $isAdminUser = strtolower($data['username']) === 'tudor';
        $data['role'] = $isAdminUser ? 'admin' : 'user';
        $data['is_approved'] = $isAdminUser ? 1 : 0;

        $user = User::create($data);

        if ($user->is_approved) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('success', 'Cont creat cu succes. Așteaptă validarea de către admin.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
