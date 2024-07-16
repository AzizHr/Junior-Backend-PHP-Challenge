<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $filable = [
        'name',
        'parent_id'
    ];

    /**
     * Get the parent category of this category.
     */
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get the child categories for this category.
     */
    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Get the products associated with the category.
     */
    public function products() {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
