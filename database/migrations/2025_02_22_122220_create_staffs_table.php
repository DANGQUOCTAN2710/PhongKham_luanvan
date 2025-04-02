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
        Schema::create('staff', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->foreignId('clinic_id')->nullable()->constrained('clinics')->onDelete('cascade'); 
            $table->enum('position', ['Tiếp đón', 'Cấp thuốc']); 
            $table->string('phone')->nullable(); // Số điện thoại
            $table->enum('status', ['Đang làm việc', 'Tạm nghỉ', 'Đã nghỉ việc'])->default('Đang làm việc'); 
            $table->timestamps(); 
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
