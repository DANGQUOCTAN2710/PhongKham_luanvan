<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalFeeToClinicalTestOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('clinical_test_orders', function (Blueprint $table) {
            $table->decimal('total_fee', 10, 2)->default(0); // Thêm trường tổng phí
        });
    }

    public function down()
    {
        Schema::table('clinical_test_orders', function (Blueprint $table) {
            $table->dropColumn('total_fee'); // Xóa trường tổng phí nếu rollback
        });
    }
}
