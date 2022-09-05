<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'attributes';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'status',
        'created_at',
        'updated_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function relationship_hasmany_for_attribute_value()
    {
        return $this->hasMany(AttributesValue::class, 'attribute_id');
    }
}
