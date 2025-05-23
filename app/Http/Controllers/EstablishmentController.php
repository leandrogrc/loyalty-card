<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;

class EstablishmentController extends Controller
{
    public function index()
    {
        $establishments = Establishment::all();

        return response()->json($establishments);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'establishment_name' => 'string|required',
            'owner_id' => 'required|exists:users,id',
            'address' => 'sometimes|string',
            'number' => 'sometimes|integer',
            'complement' => 'sometimes|string',
            'cep' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
            'country' => 'sometimes|string',
        ]);

        $establishment = Establishment::create($data);

        return response()->json($establishment, 201);
    }

    public function show($id)
    {
        $establishment = Establishment::with('owner')->findOrFail($id);

        return response()->json($establishment);
    }

    public function destroy($id)
    {
        $establishment = Establishment::findOrFail($id);
        $establishment->delete();
        return response()->json(['Mensagem' => 'Estabelecimento deletado com sucesso!']);
    }
}
