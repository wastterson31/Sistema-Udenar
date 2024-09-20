<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    protected $fillable = [
        'name',
        'cedula',
        'email',
        'password',
        'role',
        'verification_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isPresidente()
    {
        return $this->role === 'presidente';
    }

    public function isCoordinador()
    {
        return $this->role === 'coordinador';
    }

    public function isAsistente()
    {
        return $this->role === 'asistente';
    }
}
