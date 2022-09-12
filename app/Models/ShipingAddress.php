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
        'users_id',
        'customer_name',
        'phone_number',
        'city',
        'district',
        'wards',
        'address',
        'status',
        'created_at',
        'updated_at'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'id');
    }
}
