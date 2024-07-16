<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService {

    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * Get all products.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllProducts() {
        return $this->productRepository->getAll();
    }

    /**
     * Get a product by ID.
     *
     * @param int $id
     * @return \App\Models\Product|null
     */
    public function getProductById($id) {
        return $this->productRepository->getById($id);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * @return \App\Models\Product
     */
    public function createProduct(array $data) {
        return $this->productRepository->create($data);
    }

    /**
     * Update a product by ID.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Product|null
     */
    public function updateProduct($id, array $data) {
        return $this->productRepository->update($id, $data);
    }

    /**
     * Delete a product by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteProduct($id) {
        return $this->productRepository->delete($id);
    }
}
