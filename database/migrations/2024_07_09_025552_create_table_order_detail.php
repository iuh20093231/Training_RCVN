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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('detail_line'); // Tạo cột detail_line kiểu INT với AUTO_INCREMENT và PRIMARY KEY
            $table->unsignedInteger('order_id');
            $table->string('product_id', 20);
            $table->integer('price_buy');
            $table->integer('quantity');
            $table->string('shop_id', 50);
            $table->integer('receiver_id');
            $table->timestamps(); // Tạo 2 cột created_at và updated_at

            // Thiết lập khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            // Bạn có thể thêm các khóa ngoại khác nếu cần
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            // $table->foreign('receiver_id')->references('customer_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
