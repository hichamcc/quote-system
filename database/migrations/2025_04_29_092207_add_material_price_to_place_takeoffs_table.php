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
            $table->decimal('material_price', 10, 2)->nullable()->after('material_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('place_takeoffs', function (Blueprint $table) {
            $table->dropColumn('material_price');
        });
    }
};