<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'name',
        'brand',
        'category',
        'price',
        'image',
        'description',
        'stock',
    ];

    /**
     * Get all of the reviews for the Product.
     * This defines the 'reviews' relationship.
     */
    public function reviews(): HasMany  
    {
        return $this->hasMany(Review::class);
    }
}
