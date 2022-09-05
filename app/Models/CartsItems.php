<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartsItems extends Model
{
    use HasFactory;

    protected $table = 'carts_items';

    protected $fillable =
        [
            'id',
            'carts_id',
            'products_id',
            'attributes_value_id',
            'price',
            'quantity',
            'created_at',
            'updated_at'
        ];

    public function cart()
    {
        return $this->belongsTo(Carts::class, 'id');
    }

    public function list_attribute_cart()
    {
        return $this->hasMany(CartsAttribute::class, 'carts_items_id');
    }

    public function products()
    {
        return $this->belongsTo(Products::class, 'id');
    }
}
