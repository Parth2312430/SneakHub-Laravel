<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- 1. ADD THIS LINE

class Product extends Model
{
    use HasFactory;

    /**
     * Get all of the reviews for the Product.
     * This defines the 'reviews' relationship.
     */
    public function reviews(): HasMany  // <-- 2. ADD THIS ENTIRE FUNCTION
    {
        return $this->hasMany(Review::class);
    }
}
