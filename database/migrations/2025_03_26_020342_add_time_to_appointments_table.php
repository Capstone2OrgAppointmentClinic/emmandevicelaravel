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
        Schema::table('appointments', function (Blueprint $table) {
            // Check if the column does not exist before adding
            if (!Schema::hasColumn('appointments', 'time')) {
                $table->time('time')->after('date')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Check if the column exists before dropping it
            if (Schema::hasColumn('appointments', 'time')) {
                $table->dropColumn('time');
            }
        });
    }
};
