<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function loginPage()
    {
        return view('auth.login');
    }

    public function registerPage()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {

        $messages = [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'Credenciais inválidas. Por favor, tente novamente.'
        ];

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], $messages);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput()
                ->with(
                    'login_error',
                    'Credenciais inválidas. Por favor, tente novamente.'
                );
        }

        $request->session()->regenerate();
        return redirect()
            ->route('dashboard')
            ->with('success', 'Login realizado com sucesso!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
