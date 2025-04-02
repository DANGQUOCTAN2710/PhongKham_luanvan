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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();  // ID tự động tăng
            $table->string('name')->unique();  // Tên phòng khám (duy nhất)
            $table->text('address');  // Địa chỉ phòng khám
            $table->string('phone')->unique();  // Số điện thoại phòng khám (duy nhất)
            $table->string('email')->nullable();  // Email phòng khám (có thể null)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['Chờ duyệt', 'Bị từ chối', 'Đang hoạt động'])->default('Chờ duyệt');
            $table->timestamps();  // created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
