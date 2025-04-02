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
    Schema::table('prescriptions', function (Blueprint $table) {
        $table->enum('status', ['Chưa duyệt', 'Đã duyệt'])->default('Chưa duyệt'); // Thêm cột trạng thái
    });
}

public function down()
{
    Schema::table('prescriptions', function (Blueprint $table) {
        $table->dropColumn('status'); // Xóa cột trạng thái nếu rollback migration
    });
}
};
