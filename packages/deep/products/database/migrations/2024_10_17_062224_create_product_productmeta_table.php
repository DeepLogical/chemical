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
        Schema::create('product_productmeta', function (Blueprint $table) {
            $table->foreignId('product_id');
            $table->foreignId('productmeta_id');
            $table->timestamps();
            $table->primary(['product_id', 'productmeta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_productmeta');
    }
};
