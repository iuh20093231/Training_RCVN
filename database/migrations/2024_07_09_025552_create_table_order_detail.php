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
        Schema::create('mst_order_detail', function (Blueprint $table) {
            $table->increments('detail_line');
            $table->unsignedInteger('order_id');
            $table->string('product_id', 20);
            $table->integer('price_buy');
            $table->integer('quantity');
            $table->string('shop_id', 50);
            $table->integer('receiver_id');
            $table->timestamps(); 

            // Thiết lập khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('mst_order')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('mst_product')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_order_detail');
    }
};
