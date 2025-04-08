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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('customer');
            $table->string('attention')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->text('address')->nullable();
            $table->string('architect')->nullable();
            $table->date('bid_date')->nullable();
            $table->date('plan_date')->nullable();
            $table->date('date_accepted')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};