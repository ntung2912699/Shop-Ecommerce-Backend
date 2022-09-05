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

    public function get_new_produts()
    {
        $products = $this->model->orderBy('created_at', 'DESC')->limit(12)->get();
        return $products;
    }

    public function get_attribute_for_product_ids($id)
    {
        $obj = $this->model->find($id)->relationship_attribute;;
        return $obj;
    }
}
