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
        Schema::create('diagnostic_imagings', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Mã CDHA
            $table->string('name'); // Tên chẩn đoán hình ảnh
            $table->decimal('price', 10, 2); // Giá
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diagnostic_imagings');
    }
};
