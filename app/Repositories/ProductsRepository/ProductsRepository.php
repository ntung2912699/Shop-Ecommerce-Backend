<?php

namespace App\Repositories\ProductsRepository;

use App\Repositories\BaseRepository;

class ProductsRepository extends BaseRepository implements ProductsRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Products::class;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_attribute_for_product($id)
    {
        $obj = $this->model->find($id)->relationship_attribute;
        return $obj;
    }

    /**
     * @return mixed
     */
    public function get_new_produts()
    {
        $products = $this->model->orderBy('created_at', 'DESC')->paginate(8);
        return $products;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get_attribute_for_product_ids($id)
    {
        $obj = $this->model->find($id)->relationship_attribute;;
        return $obj;
    }

    public function filter_search($price_min, $price_max, $key_two, $key_three)
    {
        $result = $this->model
            ->where('price', '>=', $price_min)->where('price', '<=', $price_max)
            ->get();
        return $result;
    }
}
