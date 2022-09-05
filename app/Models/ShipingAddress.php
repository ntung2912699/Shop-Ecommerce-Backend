<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipingAddress extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shiping_address';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_profile_id',
        'country',
        'city',
        'district',
        'wards',
        'street',
        'apartment_number',
        'zip_code',
        'created_at',
        'updated_at'
    ];

    public function user_profile(){
        return $this->belongsTo(UsersProfile::class, 'id');
    }
}
