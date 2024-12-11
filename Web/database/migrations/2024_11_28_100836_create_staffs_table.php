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
        Schema::create('staffs', function (Blueprint $table) {
            // $table->id();
            $table->string('MSNV', 9)->primary();
            $table->string('Name', 100);
            $table->text('Address');
            $table->string('Phone', 100);
            $table->string('CCCD', 100);
            $table->boolean('Gender');
            $table->string('Duty', 100);
            $table->string('Image', 200);
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
