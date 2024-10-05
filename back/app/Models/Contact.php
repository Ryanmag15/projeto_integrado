<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    // Cada contato pertence a um cliente
    public function client()
    {
        return $this->belongsTo(Client::class); // FK: client_id
    }
}
