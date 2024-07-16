<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService {
    
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository) {
        $this->categoryRepository = $categoryRepository;
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
}
