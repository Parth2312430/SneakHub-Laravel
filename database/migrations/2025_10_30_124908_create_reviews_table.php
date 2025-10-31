<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            
            // This links the review to a product
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // This links the review to a logged-in user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->integer('rating'); // The 1-5 star rating
            $table->text('comment');   // The user's text
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
