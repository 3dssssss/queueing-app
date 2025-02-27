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
        Schema::create('queue_create', function (Blueprint $table) {
            $table->id();
            $table->string('queue_name'); 
            $table->enum('queue_type', ['General', 'Priority', 'Appointment-based']); 
            $table->string('queue_code')->unique(); 
            $table->string('department')->default('City Treasurers Office');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queue_create');
    }
};
