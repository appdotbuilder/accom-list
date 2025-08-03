<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['hotel', 'inn', 'house']);
            $table->text('description');
            $table->text('address');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->decimal('price_from', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            $table->timestamps();
            
            // Indexes for search performance
            $table->index('name');
            $table->index('type');
            $table->index('is_active');
            $table->index(['type', 'is_active']);
            $table->index(['price_from', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};