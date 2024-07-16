<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepositoryInterface;

class ProductCategoryService {
    
    protected $productCategoryRepository;

    public function __construct(ProductCategoryRepositoryInterface $productCategoryRepository) {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function createProductCategory(array $data) {
        return $this->productCategoryRepository->create($data);
    }
}
