<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Users;
use App\Models\Products;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contract_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Users::class);            
            $table->foreignIdFor(Products::class);
            $table->integer("price");            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_lists');
    }
};
