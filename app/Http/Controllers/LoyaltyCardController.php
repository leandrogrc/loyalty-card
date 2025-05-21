<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\LoyaltyCard;

class LoyaltyCardController extends Controller
{

    public function index()
    {
        $cards = LoyaltyCard::with('client', 'user')->get();
        return response()->json($cards);
    }

    public function store(Request $request, $clientId)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'service_date' => 'required|date',
            'validated' => 'boolean',
        ]);

        $card = LoyaltyCard::create($data);

        return response()->json($card, 201);
    }

    public function validateCard($id)
    {
        $card = LoyaltyCard::findOrFail($id);
        $card->validated = true;
        $card->save();

        return response()->json($card);
    }

    public function show($clientId)
    {
        $client = Client::where('id', $clientId)
            ->where('owner_id', 1)
            ->with('loyaltyCard.visits')
            ->firstOrFail();

        return response()->json($client->loyaltyCard);
    }
}
