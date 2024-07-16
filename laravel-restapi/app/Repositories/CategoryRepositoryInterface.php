<?php

namespace App\Repositories;

interface CategoryRepositoryInterface {
    public function getAll();
    public function create(array $data);
    public function delete($id);
    public function getById($id);
}
