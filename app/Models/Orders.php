<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'address_id',
        'payment_method_id',
        'shiping_method_id',
        'status_id',
        'phone_number',
        'grand_total',
        'note',
        'created_at',
        'updated_at',
    ];

    public function list_order_item()
    {
        return $this->hasMany( OrdersProducts::class, 'orders_id');
    }
}
