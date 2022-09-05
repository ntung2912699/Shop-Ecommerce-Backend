<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsReview extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'products_reviews';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'products_id',
        'point',
        'media',
        'content',
        'created_at',
        'updated_at'
    ];
}
