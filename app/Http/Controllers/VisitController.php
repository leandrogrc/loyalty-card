<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;
use App\Models\LoyaltyCard;

class VisitController extends Controller
{
    public function store($cardId, Request $request)
    {
        $card = LoyaltyCard::with('client')->findOrFail($cardId);

        // if ($card->client->owner_id !== auth('api')->id()) {
        //     abort(403, 'Não autorizado');
        // }

        $data = $request->validate([
            'service_date' => 'data|required',
            'client_id' => 'integer|required',
            'user_id' => 'integer|required',
        ]);

        $visit = Visit::create($data);

        return response()->json($visit, 201);
    }
}
