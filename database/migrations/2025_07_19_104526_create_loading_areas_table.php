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
        Schema::create('loading_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loading_zone_id');
            $table->foreign('loading_zone_id')->references('id')->on('loading_zones')
                    ->cascadeOnUpdate()->restrictOnDelete();
            $table->string('postal_code');
            $table->string('area_name');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loading_areas');
    }
};
