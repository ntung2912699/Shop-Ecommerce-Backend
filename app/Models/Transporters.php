<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporters extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'transporters';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'logo',
        'description',
        'created_at',
        'updated_at'
    ];
}
