<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Establishment;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index')->with('clients', $clients);
    }

    public function create()
    {
        return view('clients.create');
    }

    public function edit(Client $client)
    {
        return view('clients.edit')->with('client', $client);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:clients,email',
        ]);

        try {
            Client::create($validatedData);

            return redirect()
                ->route('clients.index')
                ->with('success', 'Cliente criado com sucesso!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Erro ao criar cliente: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255|unique:clients,email,' . $client->id,
        ]);

        $client->update($validatedData);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}
