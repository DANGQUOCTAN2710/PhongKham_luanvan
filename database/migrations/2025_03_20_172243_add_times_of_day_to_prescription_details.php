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
            $table->boolean('morning')->default(false)->after('quantity');
            $table->boolean('noon')->default(false)->after('morning');
            $table->boolean('evening')->default(false)->after('noon');
            $table->boolean('night')->default(false)->after('evening');
        });
    }
    
    public function down()
    {
        Schema::table('prescription_details', function (Blueprint $table) {
            $table->dropColumn(['morning', 'noon', 'evening', 'night']);
        });
    }
};
