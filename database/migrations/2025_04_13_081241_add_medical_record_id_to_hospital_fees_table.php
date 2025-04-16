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
        Schema::table('hospital_fees', function (Blueprint $table) {
            $table->foreignId('medical_record_id')->nullable()->constrained('medical_records')->onDelete('cascade'); // Hồ sơ khám bệnh
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hospital_fees', function (Blueprint $table) {
            // Nếu có foreign key, hãy drop trước khi xóa cột
            $table->dropForeign(['medical_record_id']); // Loại bỏ khóa ngoại
            $table->dropColumn('medical_record_id');   // Xóa cột
        });
    }
};
