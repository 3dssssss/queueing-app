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
        Schema::table('queue_create', function (Blueprint $table) {
            $table->foreignId('staff_id')->nullable()->constrained('staff')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('queue_create', function (Blueprint $table) {
            $table->dropColumn('staff_id');
        });
    }
};
