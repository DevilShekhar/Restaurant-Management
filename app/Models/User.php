<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class User extends Authenticatable implements JWTSubject
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'gender',
        'profile_photo',
        'birth_date',
        'address',
        'role',
        'branch_id',
        'status',
        'password',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}