<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Branch extends Model
{
    protected $fillable = [
        'owner_id',
        'branch_manager_id',
        'name',
        'code',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'latitude',
        'longitude',
        'gst_number',
        'fssai_license',
        'opening_time',
        'closing_time',
        'is_active'
    ];  
    public function manager()
    {
        return $this->belongsTo(User::class, 'branch_manager_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}