<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;

class ManageProduct extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:manage {action} {--id=} {--name=} {--description=} {--price=} {--image=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or delete a product';

    /**
     * The ProductService instance.
     *
     * @var ProductService
     */
    protected $productService;

    /**
     * Create a new command instance.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService) {
        parent::__construct();
        $this->productService = $productService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $action = $this->argument('action');
        $id = $this->option('id');
        $name = $this->option('name');
        $description = $this->option('description');
        $price = $this->option('price');
        $image = $this->option('image');

        switch ($action) {
            case 'create':
                $data = [];

                if ($name) {
                    $data['name'] = $name;
                }

                if ($description) {
                    $data['description'] = $description;
                }

                if ($price) {
                    $data['price'] = $price;
                }

                if ($image) {
                    $data['image'] = $image;
                }

                $product = $this->productService->createProduct($data);
                $this->info('Product created successfully: ' . $product->id);
                break;

            case 'delete':
                if (!$id) {
                    $this->error('ID is required to delete a product.');
                    return;
                }

                $result = $this->productService->deleteProduct($id);
                if ($result) {
                    $this->info('Product deleted successfully.');
                } else {
                    $this->error('Product not found.');
                }
                break;

            default:
                $this->error('Invalid action. Use "create" or "delete".');
                break;
        }
    }
}
