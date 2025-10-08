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
        Schema::create('unloading_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('unloading_zone_id');
            $table->foreign('unloading_zone_id')->references('id')->on('unloading_zones')
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
        Schema::dropIfExists('unloading_areas');
    }
};
