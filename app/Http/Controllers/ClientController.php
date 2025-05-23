<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::with('user')->get();
        return response()->json($client);
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $client = Client::create($data);

        return response()->json($client, 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'email' => 'sometimes|email|unique:users,email' . $id,
        ]);

        $client->update($data);

        return response()->json($client);
    }

    public function destroy(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['message' => 'Cliente deletado com sucesso']);
    }
}
