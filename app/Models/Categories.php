<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'logo',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relationship_for_products()
    {
        return $this->hasMany( Products::class, 'categories_id');
    }

    public function relationship_for_brands()
    {
        return $this->hasMany( Brands::class, 'categories_id');
    }
}
