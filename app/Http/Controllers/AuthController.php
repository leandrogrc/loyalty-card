<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $user = JWTAuth::user();

        return response()->json([
            'message' => 'Login bem-sucedido',
            'user' => $user,
            'authorization' => [
                'type' => 'bearer',
                'token' => $token
            ]
        ]);
    }

    public function me()
    {
        try {
            // O JWTAuth já busca o token do header Authorization automaticamente
            $token = JWTAuth::getToken();
            if (!$token) {
                return response()->json(['message' => 'Não autorizado']);
            }
            $user = JWTAuth::parseToken()->authenticate();

            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Não autenticado',
                'message' => $e->getMessage(),
            ], 401);
        }
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logout realizado com sucesso']);
    }

    public function refresh()
    {

        $token = JWTAuth::getToken();

        if (!$token) {
            return response()->json(['error' => 'Token não fornecido'], 401);
        }

        $token = JWTAuth::refresh($token);

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        $ttl = JWTAuth::factory()->getTTL();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 15,
        ]);
    }
}
