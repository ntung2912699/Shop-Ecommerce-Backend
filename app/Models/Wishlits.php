<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlits extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'whish_list';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'products_id',
        'created_at',
        'updated_at'
    ];
}
