<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    // Cada cliente pode ter muitos contatos
    public function contacts()
    {
        return $this->hasMany(Contact::class); // FK: client_id
    }

    // Cada cliente pode ter muitas tarefas (tasks)
    public function tasks()
    {
        return $this->hasMany(Task::class); // FK: client_id
    }

    // Cada cliente pode ter muitos negócios (deals)
    public function deals()
    {
        return $this->hasMany(Deal::class); // FK: client_id
    }
}
