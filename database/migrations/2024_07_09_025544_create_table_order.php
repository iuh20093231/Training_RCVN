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
        Schema::create('mst_order', function (Blueprint $table) {
            $table->increments('order_id'); 
            $table->string('order_shop', 40);
            $table->unsignedInteger('customer_id'); 
            $table->integer('total_price');
            $table->tinyInteger('payment_method')->comment('1: COD, 2: PayPal, 3: GMO');
            $table->integer('ship_charge')->nullable();
            $table->integer('tax')->nullable();
            $table->dateTime('order_date');
            $table->dateTime('shipment_date')->nullable();
            $table->dateTime('cancel_date')->nullable();
            $table->tinyInteger('order_status');
            $table->string('note_customer', 255)->nullable();
            $table->string('error_code_api', 20)->nullable();
            $table->timestamps(); 

            // Thiết lập khóa ngoại
            $table->foreign('customer_id')->references('id')->on('mst_customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mst_order');
    }
};
