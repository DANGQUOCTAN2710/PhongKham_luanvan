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
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->constrained('prescriptions')->onDelete('cascade'); // Thuộc toa thuốc nào
            $table->foreignId('medicine_id')->constrained('medicines'); // Thuốc được kê
            $table->string('dosage'); // Liều lượng
            $table->integer('quantity'); // Số lượng
            $table->decimal('total_price', 10, 2); // Tổng giá tiền
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};
