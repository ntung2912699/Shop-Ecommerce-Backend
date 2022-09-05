<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'carts';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class,'id');
    }

    public function list_cart_item()
    {
        return $this->hasMany( CartsItems::class, 'carts_id');
    }
}
