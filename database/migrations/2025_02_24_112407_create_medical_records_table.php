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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_book_id')->constrained('medical_books')->onDelete('cascade'); // Sổ bệnh
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade'); // Bác sĩ khám
            $table->foreignId('clinic_id')->constrained('clinics')->onDelete('cascade'); // Phòng khám
            $table->date('exam_date'); // Ngày khám
            $table->text('reason'); // Lý do khám
            $table->enum('status', ['chờ khám', 'đang khám', 'chờ CLS', 'đã CLS', 'đã khám'])->default('chờ khám');
        
            // Chẩn đoán & điều trị
            $table->text('diagnosis')->nullable();
            $table->string('main_disease')->nullable();
            $table->string('sub_disease')->nullable();
            $table->enum('treatment_type', ['Cấp toa', 'Cận lâm sàng'])->default('Cấp toa');
            $table->text('notes')->nullable();
        
            // Sinh hiệu
            $table->float('weight')->nullable();
            $table->float('height')->nullable();
            $table->float('bmi')->nullable();
            $table->float('temperature')->nullable();
            $table->integer('pulse')->nullable();
            $table->float('spo2')->nullable();
        
            $table->timestamps();
        });
        
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
