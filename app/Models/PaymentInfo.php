<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'payment_info';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'users_id',
        'card_name',
        'card_number',
        'card_date',
        'created_at',
        'updated_at'
    ];
}
