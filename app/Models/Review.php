<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- 1. ADD THIS LINE

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * This is required for your ReviewController to work.
     *
     * @var array
     */
    protected $fillable = [ // <-- 2. ADD THIS ENTIRE ARRAY
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    /**
     * Get the user (author) that this review belongs to.
     * This defines the 'user' relationship for your controller.
     */
    public function user(): BelongsTo // <-- 3. ADD THIS ENTIRE FUNCTION
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that this review belongs to.
     */
    public function product(): BelongsTo // <-- 4. ADD THIS FUNCTION (good practice)
    {
        return $this->belongsTo(Product::class);
    }
}
