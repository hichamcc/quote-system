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
        Schema::table('projects', function (Blueprint $table) {
            // Pricing factors stored with the project
            $table->decimal('factor_fabrication', 10, 2)->nullable()->after('project_type');
            $table->decimal('factor_edge_polish', 10, 2)->nullable();
            $table->decimal('factor_miter', 10, 2)->nullable();
            $table->decimal('factor_sink_cutout', 10, 2)->nullable();
            $table->decimal('factor_cooktop_cutout', 10, 2)->nullable();
            $table->decimal('factor_template', 10, 2)->nullable();
            $table->decimal('factor_installation', 10, 2)->nullable();
            $table->decimal('factor_overhead', 10, 2)->nullable();
            $table->decimal('factor_waste', 10, 2)->nullable();
            $table->decimal('factor_profit', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'factor_fabrication',
                'factor_edge_polish',
                'factor_miter',
                'factor_sink_cutout',
                'factor_cooktop_cutout',
                'factor_template',
                'factor_installation',
                'factor_overhead',
                'factor_waste',
                'factor_profit',
            ]);
        });
    }
};