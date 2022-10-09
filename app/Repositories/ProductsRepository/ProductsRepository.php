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
        $products = $this->model->orderBy('created_at', 'DESC')->take(12)->get();
        return $products;
    }

    /**
     * @return mixed
     */
    public function get_shop_produts()
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

    /**
     * @param $price_min
     * @param $price_max
     * @param $category_id
     * @return mixed
     */
    public function filter_search($price_min, $price_max)
    {
        $result = $this->model
            ->where('price', '>=', intval($price_min))->where('price', '<=', intval($price_max))
            ->get();
        return $result;
    }

    /**
     * @param $price_min
     * @param $price_max
     * @param $category_id
     * @return mixed
     */
    public function filter_search_cate($price_min, $price_max, $category_id)
    {
        $result = $this->model
            ->where('categories_id', '=' ,$category_id)
            ->where('price', '>=', intval($price_min))->where('price', '<=', intval($price_max))
            ->get();
        return $result;
    }
}
