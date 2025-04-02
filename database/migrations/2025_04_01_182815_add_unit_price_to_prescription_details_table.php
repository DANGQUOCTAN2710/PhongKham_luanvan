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
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->decimal('unit_price', 10, 2)->after('medicine_id'); // Thêm cột đơn giá
        });
    }

    public function down()
    {
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->dropColumn('unit_price'); // Nếu rollback, xóa cột đơn giá
        });
    }

};
