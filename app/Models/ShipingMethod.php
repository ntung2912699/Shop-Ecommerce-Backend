<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipingMethod extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'shiping_method';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'transporters_id',
        'name',
        'postage',
        'created_at',
        'updated_at'
    ];
}
