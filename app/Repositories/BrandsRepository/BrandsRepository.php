<?php

namespace App\Repositories\BrandsRepository;

use App\Models\Categories;
use App\Repositories\BaseRepository;

class BrandsRepository extends BaseRepository implements BrandsRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Brands::class;
    }

//    /**
//     * @param $id
//     * @return mixed
//     */
//    public function get_product_by_categories($id)
//    {
//        $result = $this->model->find($id)->relationship_for_products;
//        return $result;
//    }
}
