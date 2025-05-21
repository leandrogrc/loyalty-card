<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\LoyaltyCard;

class VisitController extends Controller
{
    public function store($cardId)
{
    $card = LoyaltyCard::with('client')->findOrFail($cardId);

    if ($card->client->owner_id !== auth()->id()) {
        abort(403, 'Não autorizado');
    }

    $visit = Visit::create([
        'loyalty_card_id' => $card->id,
        'signed_by' => auth()->id(),
    ]);

    $card->increment('current_visits');

    // Marcar recompensa como "disponível"
    if ($card->current_visits >= $card->total_visits_required) {
        $card->update(['is_reward_claimed' => true]);
    }

    return response()->json($visit, 201);
}

}
