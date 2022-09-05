<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributesValue extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'attribute_value';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'attribute_id',
        'product_id',
        'value',
        'description',
        'price',
        'quantity',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationship_for_attribute()
    {
        return $this->belongsTo(Attributes::class, 'id');
    }

    public function relationship_for_product()
    {
        return $this->belongsTo(Products::class, 'id');
    }
}
