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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable(); // kiểu dữ  liệu varchar, có thể rỗng
            $table->string('name');
            $table->string('email')->unique(); // kiểu dữ liệu varchar, không cho phép trùng
            $table->timestamp('email_verified_at')->nullable();// xác minh email thông
            $table->string('password'); // mật khẩu được mã hóa, kiểu dữ liệu varchar
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
