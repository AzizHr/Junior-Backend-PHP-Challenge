<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CategoryService;

class ManageCategory extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'category:manage {action} {--id=} {--name=} {--parent_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create or delete a category';

    /**
     * The CategoryService instance.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Create a new command instance.
     *
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService) {
        parent::__construct();
        $this->categoryService = $categoryService;
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
        $parent_id = $this->option('parent_id');

        switch ($action) {
            case 'create':
                if (!$name) {
                    $this->error('Name is required to create a category.');
                    return;
                }

                $data = ['name' => $name];
                if ($parent_id) {
                    $data['parent_id'] = $parent_id;
                }

                $category = $this->categoryService->createCategory($data);
                $this->info('Category created successfully: ' . $category->id);
                break;

            case 'delete':
                if (!$id) {
                    $this->error('ID is required to delete a category.');
                    return;
                }

                $result = $this->categoryService->deleteCategory($id);
                if ($result) {
                    $this->info('Category deleted successfully.');
                } else {
                    $this->error('Category not found.');
                }
                break;

            default:
                $this->error('Invalid action. Use "create" or "delete".');
                break;
        }
    }
}
