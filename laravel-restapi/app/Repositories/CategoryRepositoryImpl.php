<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepositoryImpl implements CategoryRepositoryInterface {
    
    protected $model;

    public function __construct(Category $model) {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        if ($category) {
            return $category->delete();
        }
        return false;
    }

}
