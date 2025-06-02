<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('establishments')->get();
        return response()->json($users, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $messages = [
                'name.required' => 'O campo nome é obrigatório.',
                'name.string' => 'O campo nome deve ser uma string.',
                'email.required' => 'O campo e-mail é obrigatório.',
                'email.email' => 'Informe um e-mail válido.',
                'email.unique' => 'Este e-mail já está cadastrado.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.confirmed' => 'A confirmação da senha não confere.',
                'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
            ];

            $data = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|string|min:6',
            ], $messages);

            $data['password'] = Hash::make($data['password']);
            $data['email_verified_at'] = now();

            $user = User::create($data);

            // Gera o token JWT
            $token = JWTAuth::fromUser($user);

            // Define o cookie HTTP-only
            $cookie = cookie('token', $token, 60 * 24); // 1 dia

            return response()->json($user, 201)->withCookie($cookie);
        } catch (ValidationException $validationException) {
            // Captura erros de validação e retorna JSON adequado
            return response()->json([
                'message' => 'Erro de validação',
                'errors' => $validationException->errors(),
            ], 422);
        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Erro ao criar usuário',
                'message' => $err->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('establishments')->findOrFail($id);
        return response()->json($user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso'], 200);
    }
}
