# Welcome

## Getting Started

### Prerequisites

Before starting the app, ensure you have the necessary dependencies installed.

### Installation

1. Install PHP dependencies:
    ```bash
    composer install
    ```

2. Run database migrations:
    ```bash
    php artisan migrate
    ```

3. Serve the Laravel application:
    ```bash
    php artisan serve
    ```

## Category Management

### Create a New Category

To create a new category, use the following command:
```bash
php artisan category:manage create --name="category name" --parent_id="parent id"
```

### Delete a Category

To delete a category, use the following command:
```bash
php artisan category:manage delete --id="category id"
```

## Product Management

### Create a New Product

To create a new product, use the following command:
```bash
php artisan product:manage create --name="product name" --description="product description" --price="product price" --image="product image url"
```

### Delete a Product

To delete a product, use the following command:
```bash
php artisan product:manage delete --id="product id"
```

### Starting The Vue.js App

1. Install dependencies:
    ```bash
    npm install
    ```

2. Serve the Vue.js Application:
    ```bash
    npm run dev
    ```
