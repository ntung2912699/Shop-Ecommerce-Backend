<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users_profile';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'first_name',
        'last_name',
        'DOB',
        'phone_number',
        'avatar',
        'story',
        'created_at',
        'updated_at'
    ];

    public function shipping_address(){
        return $this->hasMany(ShipingAddress::class, 'users_profile_id');
    }
}
