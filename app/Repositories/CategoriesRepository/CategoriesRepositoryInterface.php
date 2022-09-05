<?php

namespace App\Repositories\CategoriesRepository;

use Illuminate\Support\Facades\Request;

interface CategoriesRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function get_product_by_categories($id);

}
