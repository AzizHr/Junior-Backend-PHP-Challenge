<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoryService;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller {

    protected $productService;
    protected $productCategoryService;

    public function __construct(ProductService $productService, ProductCategoryService $productCategoryService) {
        $this->productService = $productService;
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index() {
        $products = $this->productService->getAllProducts();
        return response()->json($products, 200);
    }

    /**
     * Display the specified product.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id) {
        $product = $this->productService->getProductById($id);
        if ($product) {
            return response()->json($product, 200);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    /**
     * Store a newly created product.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'required|exists:categories,id'
        ]);
    
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = 'images/'.$imageName;
        }
    
        $productToBeStored = [
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $validatedData['image']
        ];

        $product = $this->productService->createProduct($productToBeStored);

        $productCategory = [
            'product_id' => $product->id,
            'category_id' => $validatedData['category_id'],
        ];

        $this->productCategoryService->createProductCategory($productCategory);

        return response()->json($product, 201);
    }
    

    /**
     * Update the specified product.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'image' => 'sometimes|required|string', // Adjusted based on the previous migration
        ]);

        $product = $this->productService->updateProduct($id, $validatedData);
        if ($product) {
            return response()->json($product, 200);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

    /**
     * Remove the specified product.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id) {
        $result = $this->productService->deleteProduct($id);
        if ($result) {
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }
        return response()->json(['message' => 'Product not found'], 404);
    }

     /**
     * Sort products by name.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortByName()
    {
        $products = $this->productService->sortProductsByName();
        return response()->json($products);
    }

    /**
     * Sort products by price.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sortByPrice()
    {
        $products = $this->productService->sortProductsByPrice();
        return response()->json($products);
    }

    /**
     * Filter products by category.
     *
     * @param int $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterByCategory($categoryId)
    {
        $products = $this->productService->filterProductsByCategory($categoryId);
        return response()->json($products);
    }
}

