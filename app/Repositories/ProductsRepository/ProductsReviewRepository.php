<?php

namespace App\Repositories\ProductsRepository;

use App\Repositories\BaseRepository;

class ProductsReviewRepository extends BaseRepository implements ProductsReviewRepositoryInterface
{

    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ProductsReview::class;
    }
}
