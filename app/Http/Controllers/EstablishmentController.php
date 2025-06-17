<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;

class EstablishmentController extends Controller
{
    public function index()
    {
        $establishments = Establishment::where('owner_id', Auth::user()->id)->get();

        return view('establishments.index')->with('establishments', $establishments);
    }

    public function show(Establishment $establishment)
    {
        // Verifica se o estabelecimento pertence ao usuário logado
        if ($establishment->owner_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        return view('establishments.show')->with('establishment', $establishment);
    }

    public function create()
    {
        return view('establishments.create');
    }

    public function edit(Establishment $establishment)
    {
        // Verifica se o estabelecimento pertence ao usuário logado
        if ($establishment->owner_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        return view('establishments.edit', compact('establishment'));
    }

    public function destroy(Establishment $establishment)
    {
        // Verifica se o estabelecimento pertence ao usuário logado
        if ($establishment->owner_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        try {
            $establishment->delete();
            return redirect()->route('establishments.index')
                ->with('success', 'Estabelecimento excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao excluir estabelecimento: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'establishment_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|integer',
            'complement' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:10|regex:/^\d{5}-?\d{3}$/',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|size:2',
            'country' => 'nullable|string|max:255',
        ], [
            'establishment_name.required' => 'O nome do estabelecimento é obrigatório',
            'cep.regex' => 'O CEP deve estar no formato 12345-678 ou 12345678',
            'state.size' => 'O estado deve ter 2 caracteres (ex: SP)',
        ]);

        $validated['owner_id'] = Auth::user()->id;

        try {
            $establishment = Establishment::create($validated);

            return redirect()
                ->route('establishments.show', $establishment)
                ->with('success', 'Estabelecimento criado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar estabelecimento: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Establishment $establishment)
    {
        // Verifica se o estabelecimento pertence ao usuário logado
        if ($establishment->owner_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado');
        }

        $validated = $request->validate([
            'establishment_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'number' => 'nullable|integer',
            'complement' => 'nullable|string|max:255',
            'cep' => 'nullable|string|max:10|regex:/^\d{5}-?\d{3}$/',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|size:2',
            'country' => 'nullable|string|max:255',
        ]);

        try {
            $establishment->update($validated);

            return redirect()
                ->route('establishments.show', $establishment)
                ->with('success', 'Estabelecimento atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar estabelecimento: ' . $e->getMessage());
        }
    }
}
