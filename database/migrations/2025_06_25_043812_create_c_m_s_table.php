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
        Schema::create('c_m_s', function (Blueprint $table) {
           $table->id();
            $table->string('page_name');
            $table->string('section_name');
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('image_url')->nullable();
            $table->string('background_image')->nullable();
            $table->text('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('button_text')->nullable();
            $table->string('bg_image_text')->nullable();
            $table->string('button_link')->nullable();
            $table->string('offices')->nullable();
            $table->string('brands')->nullable();
            $table->string('countries')->nullable();
            $table->string('employees')->nullable();
            $table->string('type')->nullable();
            $table->string('projects')->nullable();
            $table->string('other')->nullable();
            $table->enum('status', ['active','inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('c_m_s');
    }
};
