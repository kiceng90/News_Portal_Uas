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
        Schema::create('countries_categories_news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_category_id');
            $table->unsignedBigInteger('news_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->foreign('country_category_id')->references('id')->on('countries_categories')->onDelete('cascade');

            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries_categories_news');
    }
};
