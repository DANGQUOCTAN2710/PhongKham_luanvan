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
        Schema::create('clinical_test_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinical_test_order_id')->constrained('clinical_test_orders')->onDelete('cascade'); 
           
            $table->foreignId('clinical_test_id')->nullable()->constrained('clinical_tests')->onDelete('cascade');
            $table->foreignId('ultrasound_id')->nullable()->constrained('ultrasounds')->onDelete('cascade');
            $table->foreignId('diagnostic_imaging_id')->nullable()->constrained('diagnostic_imagings')->onDelete('cascade');
            
            $table->enum('status', ['Chờ thực hiện', 'Đã thực hiện'])->default('Chờ thực hiện'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_test_order_details');
    }
};
