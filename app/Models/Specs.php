<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specs extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'specs_products';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'products_id',
        'value_specs',
        'created_at',
        'updated_at'
    ];

    public function products()
    {
        return $this->hasOne(Products::class, 'products_id');
    }
}
