<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller {

    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = $this->categoryService->createCategory($validatedData);
        return response()->json($category, 201);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $result = $this->categoryService->deleteCategory($id);
        if ($result) {
            return response()->json(['message' => 'Category deleted successfully'], 200);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }
}

