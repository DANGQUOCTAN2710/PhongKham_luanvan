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
        Schema::create('hospital_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prescription_id')->nullable()->constrained('prescriptions')->onDelete('cascade'); // Đơn thuốc
            $table->foreignId('clinical_test_order_id')->nullable()->constrained('clinical_test_orders')->onDelete('cascade'); // Cận lâm sàng
            $table->decimal('examination_fee', 10, 2)->default(100000); // Phí khám
            $table->decimal('medicine_fee', 10, 2);     // Phí thuốc
            $table->decimal('clinical_fee', 10, 2);     // Phí cận lâm sàng
            $table->decimal('total_fee', 10, 2);        // Tổng viện phí
            $table->enum('status', ['Chưa thanh toán', 'Đã thanh toán'])->default('Chưa thanh toán');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_fees');
    }
};
