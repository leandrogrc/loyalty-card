<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'establishment_name',
        'owner_id',
        'address',
        'number',
        'complement',
        'cep',
        'city',
        'state',
        'country',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
