<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'image'
    ];

    /**
     * Get the categories associated with the product.
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
}
