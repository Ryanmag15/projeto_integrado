<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory;

    // Cada permissão pode ser atribuída a muitos papéis
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission'); // Tabela pivô: role_permission
    }
}
