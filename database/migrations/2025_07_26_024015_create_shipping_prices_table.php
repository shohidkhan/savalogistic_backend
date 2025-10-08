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
        Schema::create('shipping_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loading_country_id');
            $table->foreign('loading_country_id')->references('id')->on('countries')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('unloading_country_id');
            $table->foreign('unloading_country_id')->references('id')->on('countries')
                    ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('loading_zone_id');
            $table->foreign('loading_zone_id')->references('id')->on('loading_zones')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('unloading_zone_id');
            $table->foreign('unloading_zone_id')->references('id')->on('unloading_zones')
                    ->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedBigInteger('loading_area_id');
            $table->foreign('loading_area_id')->references('id')->on('loading_areas')
                    ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('unloading_area_id');
            $table->foreign('unloading_area_id')->references('id')->on('unloading_areas')
                    ->cascadeOnUpdate()->cascadeOnDelete();

            $table->float('ldm')->nullable();
            $table->float('gross_weight')->nullable();
            $table->float('total_price');
            $table->float('adr_fee')->nullable();
            $table->string('cargo_type')->nullable();
            $table->date('shipping_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_prices');
    }
};
