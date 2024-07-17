<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\ProductService;
use App\Services\ProductCategoryService;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductControllerTest extends TestCase
{
    protected $productService;
    protected $productCategoryService;
    protected $productController;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productService = $this->createMock(ProductService::class);
        $this->productCategoryService = $this->createMock(ProductCategoryService::class);
        $this->productController = new ProductController($this->productService, $this->productCategoryService);
    }

    public function testStore()
    {
        Storage::fake('public');

        $request = Request::create('/api/products', 'POST', [
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 99.99,
            'category_id' => 1
        ], [], [
            'image' => UploadedFile::fake()->image('test.jpg')
        ]);

        $this->productService->method('createProduct')->willReturn((object) ['id' => 1, 'name' => 'Test Product']);
        $this->productCategoryService->method('createProductCategory')->willReturn(true);

        $response = $this->productController->store($request);
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertStringContainsString('Test Product', $response->getContent());
    }

    public function testDestroy()
    {
        $this->productService->method('deleteProduct')->with(1)->willReturn(true);

        $response = $this->productController->destroy(1);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString('Product deleted successfully', $response->getContent());
    }

    public function testDestroyNotFound()
    {
        $this->productService->method('deleteProduct')->with(1)->willReturn(false);

        $response = $this->productController->destroy(1);
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('Product not found', $response->getContent());
    }
}
