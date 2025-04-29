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
        Schema::table('place_takeoffs', function (Blueprint $table) {
            $table->renameColumn('place', 'amg_job_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('place_takeoffs', function (Blueprint $table) {
            $table->renameColumn('amg_job_number', 'place');
        });
    }
};