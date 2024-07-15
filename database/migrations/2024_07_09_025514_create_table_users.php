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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Tương đương với $table->bigIncrements('id')
            $table->string('name', 255);
            $table->string('email', 255)->unique();
            $table->string('password', 255);
            $table->string('remember_token',100)->nullable();
            $table->string('verify_email', 100)->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('0: Không hoạt động, 1: Hoạt động');
            $table->tinyInteger('is_delete')->default(0)->comment('0: Bình thường, 1: Đã xóa');
            $table->string('group_role', 50)->default('user');
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 40)->nullable();
            $table->timestamps(); // Tạo 2 cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};