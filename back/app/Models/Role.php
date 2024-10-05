<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    // Cada papel pode ter muitos usuários
    public function users()
    {
        return $this->hasMany(User::class); // FK: role_id
    }

    // Cada papel pode ter muitas permissões
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission'); // Tabela pivô: role_permission
    }
}
