<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use Illuminate\Support\Facades\Auth;

class EstablishmentController extends Controller
{
    public function index()
    {
        $establishments = Establishment::all();
        return response()->json($establishments, 200);
    }

    public function establishments_by_user()
    {
        $establishments = Establishment::where('owner_id', Auth::id())->get();

        return response()->json($establishments);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'establishment_name' => 'string|required',
            'address' => 'sometimes|string',
            'number' => 'sometimes|integer',
            'complement' => 'sometimes|string',
            'cep' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string',
            'country' => 'sometimes|string',
        ]);

        $data['owner_id'] = Auth::id();

        $establishment = Establishment::create($data);

        return response()->json($establishment, 201);
    }

    public function show($id)
    {
        $establishment = Establishment::with('owner')->findOrFail($id);
        return response()->json($establishment, 200);
    }

    public function destroy($id)
    {
        $establishment = Establishment::findOrFail($id);
        $establishment->delete();
        return response()->json(['Mensagem' => 'Estabelecimento deletado com sucesso!']);
    }
}
