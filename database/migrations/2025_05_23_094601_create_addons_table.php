<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            
            // Type/Area
            $table->string('type')->nullable(); // area
            
            // Sink details
            $table->string('sink_model')->nullable();
            $table->string('sink_name')->nullable();
            $table->decimal('sink_price', 10, 2)->nullable();
            
            // Edge (yes/no with conditional price)
            $table->boolean('edge')->default(false);
            $table->decimal('edge_price', 10, 2)->nullable();
            
            // Plumbing (yes/no with conditional price)
            $table->boolean('plumbing')->default(false);
            $table->decimal('plumbing_price', 10, 2)->nullable();
            
            // Bracket details
            $table->string('bracket_model')->nullable();
            $table->string('bracket_name')->nullable();
            $table->decimal('bracket_price', 10, 2)->nullable();
            
            // Demo (yes/no with price)
            $table->boolean('demo')->default(false);
            $table->decimal('demo_price', 10, 2)->nullable();
            
            // Vein exact match (yes/no with conditional price)
            $table->boolean('vein_exact_match')->default(false);
            $table->decimal('vein_exact_match_price', 10, 2)->nullable();
            
            // Electrical Cutout (yes/no with conditional price)
            $table->boolean('electrical_cutout')->default(false);
            $table->decimal('electrical_cutout_price', 10, 2)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addons');
    }
}