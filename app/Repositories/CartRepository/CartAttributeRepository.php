<?php

namespace App\Repositories\CartRepository;

use App\Repositories\BaseRepository;

class CartAttributeRepository  extends BaseRepository implements CartAttributeRepositoryInterface
{
    /**
     * @return string
     */
    public function getModel()
    {
        return \App\Models\CartsAttribute::class;
    }

    /**
     * @param $cart_item_id
     * @param $attributes_value_id
     * @return mixed
     */
    public function compare_item_attribute($cart_item_id, $attributes_value_id)
    {
        return $this->model
            ->where('carts_items_id', '=', $cart_item_id)
            ->where('attribute_value_id' , '=' , $attributes_value_id)
            ->exists();
    }

}
