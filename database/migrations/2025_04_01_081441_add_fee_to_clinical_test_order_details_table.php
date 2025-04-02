<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeToClinicalTestOrderDetailsTable extends Migration
{
    public function up()
    {
        Schema::table('clinical_test_order_details', function (Blueprint $table) {
            $table->decimal('fee', 10, 2)->default(0); // Thêm trường phí cho từng xét nghiệm
        });
    }

    public function down()
    {
        Schema::table('clinical_test_order_details', function (Blueprint $table) {
            $table->dropColumn('fee'); // Xóa trường phí nếu rollback
        });
    }
}
