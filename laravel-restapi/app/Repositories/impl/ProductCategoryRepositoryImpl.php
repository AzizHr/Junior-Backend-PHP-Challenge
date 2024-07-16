<?php

namespace App\Repositories\Impl;

use App\Repositories\ProductCategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepositoryImpl implements ProductCategoryRepositoryInterface {

    public function create(array $data)
    {
        return DB::table('product_categories')->insert($data);
    }

}
