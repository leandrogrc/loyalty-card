<?php

namespace App\Http\Controllers;

use App\Models\Establishment;
use App\Models\LoyaltyCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoyaltyCardController extends Controller
{

    public function index()
    {
        $cards = LoyaltyCard::with('client', 'user')->get();
        return response()->json($cards, 200);
    }

    public function loyalty_card_by_establishment(Request $request)
    {
        $establishmentId = $request->query('establishment_id');

        $loyaltyCards = LoyaltyCard::with('client')
            ->where('establishment_id', $establishmentId)
            ->get();

        return response()->json($loyaltyCards, 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'establishment_id' => 'required|exists:establishments,id',
            'total_visits_required' => 'required|integer|min:1',
            'paid_visits' => 'integer|sometimes',
            'rewards_to_claim' => 'integer|sometimes',
            'rewards_claimed' => 'integer|sometimes'
        ]);

        $card = LoyaltyCard::create($data);

        return response()->json($card, 201);
    }

    public function validate_visit($id)
    {
        $card = LoyaltyCard::findOrFail($id);
        $card->increment('paid_visits');
        $card->save();

        if ($card->current_visits % $card->total_visits_required === 0) {
            $card->increment('rewards_to_claim');
            $card->save();
        }

        return response()->json($card, 200);
    }

    public function claim_reward($id)
    {
        $card = LoyaltyCard::findOrFail($id);

        if ($card->rewards_to_claim > 0) {
            $card->decrement('rewards_to_claim');
            $card->increment('rewards_claimed');
            $card->save();
        }

        return response()->json($card, 200);
    }

    public function show($id)
    {
        $loyalty_card = LoyaltyCard::findOrFail($id);

        return response()->json([
            'id' => $loyalty_card->id,
            'paid_visits' => $loyalty_card->paid_visits,
            'total_visits_required' => $loyalty_card->total_visits_required,
            'rewards_claimed' => $loyalty_card->rewards_claimed,
            'rewards_to_claim' => $loyalty_card->rewards_to_claim,
            'client_name' => $loyalty_card->client->name,
        ], 200);
    }
}
