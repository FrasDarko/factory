<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Products;
use App\Models\PriceList;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_price_lists', function (Blueprint $table) {
            $table->id();
            $table->integer("price");
            $table->foreignIdFor(Products::class);
            $table->foreignIdFor(PriceList::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_price_lists');
    }
};
