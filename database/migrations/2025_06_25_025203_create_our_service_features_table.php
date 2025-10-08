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
        Schema::create('our_service_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('our_service_id')->constrained()->onDelete('cascade');
            $table->string('feature_title')->nullable();
            $table->text('feature_description')->nullable();
            $table->string('feature_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_service_features');
    }
};
