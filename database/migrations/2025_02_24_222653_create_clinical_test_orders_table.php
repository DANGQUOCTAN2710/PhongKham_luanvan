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
        Schema::create('clinical_test_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id')->constrained('medical_records')->onDelete('cascade'); // Hồ sơ bệnh án
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Bác sĩ yêu cầu
            $table->enum('status', ['Chờ thực hiện', 'Đã thực hiện'])->default('Chờ thực hiện'); // Trạng thái xét nghiệm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_test_orders');
    }
};
