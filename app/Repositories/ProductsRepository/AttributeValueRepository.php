<?php

namespace App\Repositories\ProductsRepository;

use App\Models\AttributesValue;
use App\Repositories\BaseRepository;

class AttributeValueRepository extends BaseRepository implements AttributeValueRepositoryInterface
{

    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\AttributesValue::class;
    }
}
