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
        Schema::create('mst_shop', function (Blueprint $table) {
            $table->tinyIncrements('shop_id'); // Tạo cột shop_id kiểu TINYINT với AUTO_INCREMENT và PRIMARY KEY
            $table->string('shop_name', 255);
            $table->timestamps(); // Tạo 2 cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_shop');
    }
};
