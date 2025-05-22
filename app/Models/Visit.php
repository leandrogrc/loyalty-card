<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['client_id', 'user_id'];

    public function loyaltyCard()
    {
        return $this->belongsTo(LoyaltyCard::class, 'client_id');
    }

    public function signedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
