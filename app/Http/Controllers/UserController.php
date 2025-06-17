<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function registerPage()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store1(Request $request)
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

            return redirect()->route('login');
        } catch (\Exception $err) {
            return response()->json([
                'error' => 'Erro ao criar usuário',
                'message' => $err->getMessage()
            ], 500);
        }
    }

    public function register(Request $request)
    {
        $messages = [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Informe um e-mail válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'As senhas não coincidem.',
            'password.min' => 'A senha deve ter no mínimo 6 caracteres.',
        ];

        $user = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:6',
        ], $messages);

        User::create($user);

        return redirect('login')->with('success', 'Conta criada! Agora você pode fazer login.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        User::where(Auth::id());
        return view('users.show');
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
    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        // Validação inicial que sempre será executada
        $validated = $request->validate([
            'current_password' => 'required|string', // Sempre obrigatório
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|confirmed|min:8', // Nova senha (opcional)
        ]);

        // Verificação da senha atual (agora obrigatória para qualquer atualização)
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['error' => 'Senha atual incorreta']);
        }

        // Remove a senha atual do array de atualização
        unset($validated['current_password']);

        // Se uma nova senha foi fornecida, faz o hash
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            // Remove o campo password se não foi fornecido
            unset($validated['password']);
        }

        // Atualiza os dados do usuário
        $user->update($validated);

        return redirect()->route('users.show')
            ->with('success', 'Perfil atualizado com sucesso');
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
