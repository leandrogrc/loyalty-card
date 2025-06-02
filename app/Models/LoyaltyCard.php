<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyCard extends Model
{

    protected $fillable = [
        'client_id',
        'user_id',
        'paid_visits',
        'establishment_id',
        'total_visits_required',
        'rewards_to_claim',
        'rewards_claimed'
    ];

    protected $casts = [
        'service_date' => 'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
