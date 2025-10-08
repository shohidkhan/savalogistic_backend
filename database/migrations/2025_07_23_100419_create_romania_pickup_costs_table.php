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
        Schema::create('romania_pickup_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ldm_id');
            $table->foreign('ldm_id')->references('id')->on('l_d_m_s')
                    ->cascadeOnUpdate()->restrictOnDelete();
            $table->float('cost');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('romania_pickup_costs');
    }
};
