<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductCategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    protected $productCategoryService;
    protected $productService;
    protected $categoryService;

    public function __construct(ProductCategoryService $productCategoryService,
    ProductService $productService, CategoryService $categoryService) {
        $this->productCategoryService = $productCategoryService;
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }


    public function store(Request $request) {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'category_id' => 'required',
        ]);

        $product = $this->productService->getProductById($validatedData['product_id']);
        $category = $this->categoryService->getCategoryById($validatedData['category_id']);

        if ($product) {
            if($category) {
                $this->productCategoryService->createProductCategory($validatedData);
                return response()->json(['message' => 'Product assigned with success'], 201);
            }
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }
}
