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

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $card = LoyaltyCard::create($data);

        return response()->json($card, 201);
    }

    public function validate_visit($id)
    {
        $card = LoyaltyCard::findOrFail($id);
        $card->increment('current_visits');
        $card->save();

        if ($card->current_visits % $card->total_visits_required === 0) {
            $card->increment('rewards_claimed');
            $card->save();
        }

        return response()->json($card);
    }

    public function claim_reward($id)
    {
        $card = LoyaltyCard::findOrFail($id);

        if ($card->rewards_claimed > 0) {
            $card->decrement('rewards_claimed');
            $card->save();
        }

        return response()->json($card);
    }

    public function show($id)
    {
        $loyalty_card = LoyaltyCard::findOrFail($id);

        return response()->json([
            'id' => $loyalty_card->id,
            'current_visits' => $loyalty_card->current_visits,
            'total_visits_required' => $loyalty_card->total_visits_required,
            'rewards_claimed' => $loyalty_card->rewards_claimed,
            'rewards_to_claim' => $loyalty_card->rewards_to_claim,
            'client_name' => $loyalty_card->client->name,
        ]);
    }
}
