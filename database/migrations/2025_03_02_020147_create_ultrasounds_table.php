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
        Schema::create('ultrasounds', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Ultrasound code
            $table->string('name'); // Ultrasound name
            $table->decimal('price', 10, 2); // Price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ultrasounds');
    }
};
