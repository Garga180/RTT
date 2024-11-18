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
        Schema::create('update_stock', function (Blueprint $table) {
            $table->id();
            $table->string('ItemName')->nullable(false);
            $table->string('ItemDescription');
            $table->integer('ItemPrice')->nullable(false);
            $table->integer('Quantity')->nullable(false);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_stock');
    }
};
