<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepositoryImpl implements ProductRepositoryInterface {

    protected $model;

    public function __construct(Product $model) {
        $this->model = $model;
    }

    public function getAll() {
        return $this->model->all();
    }

    public function getById($id) {
        return $this->model->find($id);
    }
    
    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update($id, array $data) {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id) {
        $product = $this->model->find($id);
        if ($product) {
            return $product->delete();
        }
        return false;
    }
}
