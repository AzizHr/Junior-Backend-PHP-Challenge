<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService {
    
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories() {
        return $this->categoryRepository->getAll();
    }

    /**
     * Create a new category.
     *
     * @param array $data
     * @return mixed
     */
    public function createCategory(array $data) {
        return $this->categoryRepository->create($data);
    }

    /**
     * Delete a category by ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteCategory($id) {
        return $this->categoryRepository->delete($id);
    }

    public function getCategoryById($id) {
        return $this->categoryRepository->getById($id);
    }
}
