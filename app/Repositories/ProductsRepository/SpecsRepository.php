<?php

namespace App\Repositories\ProductsRepository;

use App\Repositories\BaseRepository;

class SpecsRepository extends BaseRepository implements SpecsRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Specs::class;
    }
}
