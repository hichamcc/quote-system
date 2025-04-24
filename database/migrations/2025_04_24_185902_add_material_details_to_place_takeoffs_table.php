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
            $table->string('material_name')->nullable();
            $table->string('supplier')->nullable();
            $table->string('area')->nullable();
            $table->string('piece_number')->nullable();
            $table->decimal('length', 8, 2)->nullable();
            $table->decimal('width', 8, 2)->nullable();
            $table->decimal('polished_edge_length', 8, 2)->nullable();
            $table->decimal('miter_edge_length', 8, 2)->nullable();
            $table->integer('sink_cutout')->nullable();
            $table->integer('cooktop_cutout')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('place_takeoffs', function (Blueprint $table) {
            $table->dropColumn([
                'material_name',
                'supplier',
                'area',
                'piece_number',
                'length',
                'width',
                'polished_edge_length',
                'miter_edge_length',
                'sink_cutout',
                'cooktop_cutout',
            ]);
        });
    }
};