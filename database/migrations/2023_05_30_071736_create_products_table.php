<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');

            $table->string('title');
            $table->string('price');
            $table->string('brand')->nullable();
            $table->string('product_code');
            $table->mediumText('small_description')->nullable();
            $table->string('description');
            $table->integer('quantity');
            $table->tinyInteger('status')->default('0')->comment('1=hidden,0=visible');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        // Schema::dropIfExists('products');
    }
};