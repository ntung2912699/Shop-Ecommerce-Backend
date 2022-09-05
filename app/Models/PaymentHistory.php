<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'payment_history';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'status',
        'total_payment',
        'time_payment',
        'created_at',
        'updated_at'
    ];
}
