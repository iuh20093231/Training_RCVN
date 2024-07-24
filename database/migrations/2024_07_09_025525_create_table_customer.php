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
        Schema::create('mst_customer', function (Blueprint $table) {
            $table->increments('id'); // Tạo cột customer_id kiểu INT với AUTO_INCREMENT và PRIMARY KEY
            $table->string('customer_name', 255);
            $table->string('email', 255)->unique();
            $table->string('tel_num', 14);
            $table->string('address', 255);
            $table->tinyInteger('is_active')->nullable();
            $table->timestamps(); // Tạo 2 cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_customer');
    }
};
