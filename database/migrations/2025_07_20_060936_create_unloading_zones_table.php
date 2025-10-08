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
        Schema::create('unloading_zones', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries')
                    ->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name')->unique();
            $table->string('time');
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unloading_zones');
    }
};
