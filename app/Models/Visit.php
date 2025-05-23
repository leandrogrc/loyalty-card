<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['client_id', 'user_id', 'service_date', 'loyalty_card_id'];

    public function client()
    {
        return $this->belongsTo(LoyaltyCard::class, 'client_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function loyalty_card()
    {
        return $this->belongsTo(LoyaltyCard::class, 'loyalty_card_id');
    }
}
