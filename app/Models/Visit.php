<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['client_id', 'establishment_id', 'service_date', 'loyalty_card_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function establishment()
    {
        return $this->belongsTo(Establishment::class, 'establishment_id');
    }

    public function loyalty_card()
    {
        return $this->belongsTo(LoyaltyCard::class, 'loyalty_card_id');
    }
}
