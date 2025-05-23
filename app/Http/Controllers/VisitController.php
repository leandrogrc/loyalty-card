<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\LoyaltyCard;

class VisitController extends Controller
{
    public function store(Request $request)
    {
        //$card = LoyaltyCard::with('client')->findOrFail($cardId);

        // if ($card->client->owner_id !== auth('api')->id()) {
        //     abort(403, 'Não autorizado');
        // }


        $data = $request->validate([
            'service_date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'loyalty_card_id' => 'required|exists:loyalty_cards,id',
        ]);

        $visit = Visit::create($data);

        $loyalty_card = LoyaltyCard::findOrFail($data['loyalty_card_id']);
        $loyalty_card->increment('paid_visits');
        $loyalty_card->refresh();

        if ($loyalty_card->paid_visits % $loyalty_card->total_visits_required === 0) {
            $loyalty_card->increment('rewards_to_claim');
        }

        return response()->json($visit, 201);
    }

    public function index()
    {
        $visits = Visit::all();

        return response()->json($visits);
    }
}
