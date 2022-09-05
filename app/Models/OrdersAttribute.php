<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersAttribute extends Model
{
    use HasFactory;

    protected $table = 'orders_attributes';

    protected $fillable =
        [
            'id',
            'attribute_value_id',
            'orders_products_id',
            'created_at',
            'updated_at'
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_product()
    {
        return $this->belongsTo(OrdersProducts::class, 'id');
    }
}
