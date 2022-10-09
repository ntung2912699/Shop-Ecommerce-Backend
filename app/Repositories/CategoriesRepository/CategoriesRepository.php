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
        return $result;
    }

//    public function filter_search($category_id, $min, $max){
//        $result = $this->model
//            ->where('id', '=', $category_id)
//            ->where('price', '>=', intval($min))->where('price', '<=', intval($max))
//            ->get();
//        return $result;
//    }
}
