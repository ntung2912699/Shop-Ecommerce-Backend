<?php

namespace App\Repositories\ProductsRepository;

use App\Repositories\BaseRepository;

class ProductsAttributeRepository extends BaseRepository implements ProductsAttributeRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\AttributesProducts::class;
    }
}
