<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('email')->nullable();
            $table->string('system_name')->nullable();
            $table->string('copyright_text')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('address')->nullable();
            $table->string('address2')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('opening_time2')->nullable();
            $table->string('opening_time3')->nullable();
            $table->string('opening_time4')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('system_settings');
    }
};
