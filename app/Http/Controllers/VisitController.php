<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\LoyaltyCard;

class VisitController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->validate([
            'service_date' => 'required|date',
            'client_id' => 'required|exists:clients,id',
            'establishment_id' => 'required|exists:establishments,id',
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
        $visits = Visit::all()->sort();

        return response()->json($visits, 200);
    }
}
