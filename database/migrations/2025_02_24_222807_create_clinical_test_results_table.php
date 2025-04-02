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
        Schema::create('clinical_test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinical_test_order_detail_id')
                  ->constrained('clinical_test_order_details')
                  ->onDelete('cascade'); // Liên kết chi tiết phiếu chỉ định
        
            $table->text('result')->nullable(); // Kết quả xét nghiệm
            $table->string('file', 255)->nullable();
            $table->string('status')->default('Chưa duyệt'); 
            $table->timestamp('verified_at')->nullable(); // Thời gian duyệt kết quả    
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Người duyệt kết quả
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinical_test_results');
    }
};
