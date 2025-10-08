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
        Schema::create('apply_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('job_placement_id');
            $table->foreign('job_placement_id')->references('id')->on('job_placements')->cascadeOnUpdate()->restrictOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('resume');
            $table->string('position');
            $table->boolean('agree_privacy_policy');
            $table->enum('status',['pending','shortlisted','reject','confirm'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apply_jobs');
    }
};
