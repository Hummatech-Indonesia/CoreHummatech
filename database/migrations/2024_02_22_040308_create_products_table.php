<?php

use App\Enums\ProductEnum;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_product_id')->constrained('category_products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('description');
            $table->string('link');
            $table->foreignId('service_id')->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('image');
            $table->enum('type', [ProductEnum::COMPANY->value, ProductEnum::SERVICE->value, ProductEnum::PORTFOLIO->value]);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
