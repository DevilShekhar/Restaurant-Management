<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'owner_id',
        'branch_id',
        'name',
        'description',
        'image',
        'is_active'
    ];

    public function owner()
    {
        return $this->belongsTo(
            User::class,
            'owner_id'
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class,
            'branch_id'
        );
    }
}