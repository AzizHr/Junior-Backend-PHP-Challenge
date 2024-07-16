<?php

namespace App\Repositories\Impl;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryImpl implements CategoryRepositoryInterface {
    
    protected $model;

    public function __construct(Category $model) {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model::all();
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

    public function getById($id)
    {
        return $this->model->find($id);
    }

}
