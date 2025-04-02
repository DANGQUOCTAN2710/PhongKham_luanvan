<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên thuốc
            $table->string('dosage'); // Hàm lượng (VD: 500mg)
            $table->string('unit'); // Đơn vị (Viên, gói, ml)
            $table->text('instructions'); // Hướng dẫn sử dụng
            $table->decimal('price', 10, 2); // Giá thuốc
            $table->integer('stock')->default(0); // Số lượng tồn kho
            $table->enum('status', ['Còn hàng', 'Hết hàng'])->default('Còn hàng'); // Trạng thái thuốc
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
