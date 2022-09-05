<?php

namespace App\Repositories\ProductsRepository;

use App\Repositories\BaseRepository;

class AttributesRepository extends BaseRepository implements AttributesRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Attributes::class;
    }
}
