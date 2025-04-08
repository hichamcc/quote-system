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
        Schema::create('tops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('place_takeoff_id')->constrained()->onDelete('cascade');
            $table->string('elevation')->nullable();
            $table->string('detail')->nullable();
            $table->string('area')->nullable();
            $table->string('color')->nullable();
            $table->string('supplier_brand')->nullable();
            $table->string('type')->nullable();
            $table->string('unit_qty')->nullable();
            $table->string('thickness')->nullable();
            $table->string('length_inches')->nullable();
            $table->string('width_inches')->nullable();
            $table->string('sqft_per_unit')->nullable();
            $table->string('total_sqft_counter_top')->nullable();
            $table->string('polished_edge_inches')->nullable();
            $table->string('polished_edge_lnft')->nullable();
            $table->string('total_pol_edge_lnft')->nullable();
            $table->string('lmnt_mtr_edge_inches')->nullable();
            $table->string('lmnt_mtr_edge_lnft')->nullable();
            $table->string('total_lmn_mtr_edge_lnft')->nullable();
            $table->string('num_of_sinks_per_unit')->nullable();
            $table->string('total_sinks_per_unit')->nullable();
            $table->string('num_of_cook_tops_per_unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tops');
    }
};