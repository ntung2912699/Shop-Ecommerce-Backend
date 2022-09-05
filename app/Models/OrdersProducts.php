<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders_products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'orders_id',
        'products_id',
        'price',
        'quantity',
        'total',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Orders::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function list_attribute_order()
    {
        return $this->hasMany(OrdersAttribute::class, 'orders_products_id');
    }
}
