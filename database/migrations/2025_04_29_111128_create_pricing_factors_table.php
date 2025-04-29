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
        Schema::create('pricing_factors', function (Blueprint $table) {
            $table->id();
            
            // Residential pricing factors
            $table->decimal('residential_fabrication', 10, 2)->default(4.00);
            $table->decimal('residential_edge_polish', 10, 2)->default(4.00);
            $table->decimal('residential_miter', 10, 2)->default(30.00);
            $table->decimal('residential_sink_cutout', 10, 2)->default(150.00);
            $table->decimal('residential_cooktop_cutout', 10, 2)->default(75.00);
            $table->decimal('residential_template', 10, 2)->default(1.00);
            $table->decimal('residential_installation', 10, 2)->default(7.00);
            $table->decimal('residential_overhead', 10, 2)->default(20.00);
            $table->decimal('residential_waste', 10, 2)->default(26.00);
            $table->decimal('residential_profit', 10, 2)->default(20.00);
            
            // Contractor pricing factors
            $table->decimal('contractor_fabrication', 10, 2)->default(3.50);
            $table->decimal('contractor_edge_polish', 10, 2)->default(4.00);
            $table->decimal('contractor_miter', 10, 2)->default(25.00);
            $table->decimal('contractor_sink_cutout', 10, 2)->default(125.00);
            $table->decimal('contractor_cooktop_cutout', 10, 2)->default(50.00);
            $table->decimal('contractor_template', 10, 2)->default(1.00);
            $table->decimal('contractor_installation', 10, 2)->default(7.00);
            $table->decimal('contractor_overhead', 10, 2)->default(20.00);
            $table->decimal('contractor_waste', 10, 2)->default(26.00);
            $table->decimal('contractor_profit', 10, 2)->default(20.00);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_factors');
    }
};