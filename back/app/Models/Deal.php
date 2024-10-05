<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deal extends Model
{
    use HasFactory;

    // Cada negócio pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class); // FK: user_id
    }

    // Cada negócio pertence a um cliente
    public function client()
    {
        return $this->belongsTo(Client::class); // FK: client_id
    }
}
