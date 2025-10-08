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
        Schema::create('job_placements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('department');
            $table->longText('description');
            $table->string('location');
            $table->enum('career_level',['Graduate','Professional','Academic']);
            $table->enum('employment_status',['Part Time','Full Time']);
            $table->date('deadline');
             $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_placements');
    }
};
