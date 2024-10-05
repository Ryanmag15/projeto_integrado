<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Cada usuário pertence a um papel (role)
    public function role()
    {
        return $this->belongsTo(Role::class); // FK: role_id
    }

    // Cada usuário pode ter muitas tarefas (tasks)
    public function tasks()
    {
        return $this->hasMany(Task::class); // FK: user_id
    }

    // Cada usuário pode ter muitos negócios (deals)
    public function deals()
    {
        return $this->hasMany(Deal::class); // FK: user_id
    }
}
