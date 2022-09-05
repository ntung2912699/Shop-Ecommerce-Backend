<?php

namespace App\Repositories\CategoriesRepository;

use App\Models\Categories;
use App\Repositories\BaseRepository;

class CategoriesRepository extends BaseRepository implements CategoriesRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Categories::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_product_by_categories($id)
    {
        $result = $this->model->find($id);
        $result->products = $result->relationship_for_products;
        $result->brands = $result->relationship_for_brands;
        return $result;
    }
}
