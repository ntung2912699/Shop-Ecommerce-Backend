<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string[]
     */
    protected $fillable = [
      'id',
      'categories_id',
      'brands_id',
      'name',
      'thumbnail',
      'gallery',
      'price',
      'quantity',
      'short_description',
      'status',
      'count',
      'created_at',
      'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function relationship_for_categories()
    {
        return $this->belongsTo( Categories::class, 'categories_id');
    }

    public function relationship_for_brands()
    {
        return $this->belongsTo( Brands::class, 'brands_id');
    }

    public function relationship_for_attribute()
    {
        return $this->belongsToMany(Attributes::class,
            'attribute_value',
            'product_id',
            'id'
        );
    }

    public function relationship_attribute()
    {
        return $this->hasMany(AttributesValue::class,
            'product_id'
        );
    }

    public function item_cart(){
        return $this->hasMany(CartsItems::class, 'products_id');
    }

    public function specs()
    {
        return $this->hasOne(Specs::class, 'id');
    }
}
