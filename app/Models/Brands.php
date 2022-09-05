<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'brands';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'categories_id',
        'name',
        'logo',
        'short_description',
        'created_at',
        'updated_at'
    ];

    public function relationship_for_categories()
    {
        return $this->belongsTo( Categories::class, 'id');
    }

    public function relationship_for_products()
    {
        return $this->hasMany( Products::class, 'brands_id');
    }
}
