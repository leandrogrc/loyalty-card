<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'owner_id',
        'establishment_name',
        'address'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
