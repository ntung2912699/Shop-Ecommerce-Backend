<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartsAttribute extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'carts_attributes';

    /**
     * @var string[]
     */
    protected $fillable =
        [
            'id',
            'attribute_value_id',
            'carts_items_id',
            'created_at',
            'updated_at'
        ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart_items()
    {
        return $this->belongsTo(CartsItems::class, 'id');
    }
}
