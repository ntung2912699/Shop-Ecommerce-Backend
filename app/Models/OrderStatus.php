<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'orders_status';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'status',
        'created_at',
        'updated_at'
    ];
}
