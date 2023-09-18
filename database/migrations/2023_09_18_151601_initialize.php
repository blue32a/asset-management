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
        Schema::create('custodian', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 20);
        });

        Schema::create('currency', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 20);
            $table->char('code', 3)->unique();
        });

        Schema::create('asset_class', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 20);
        });

        Schema::create('asset_region', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 20);
        });

        Schema::create('instrument', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('currency_id');
            $table->string('name', 30);
            $table->string('symbol', 4);

            $table->foreign('currency_id')->references('id')->on('currency');
        });

        Schema::create('instrument_asset_allocation', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('instrument_id');
            $table->unsignedTinyInteger('asset_class_id');
            $table->unsignedTinyInteger('asset_region_id');
            $table->double('ratio', 5, 2);

            $table->foreign('instrument_id')->references('id')->on('instrument');
            $table->foreign('asset_class_id')->references('id')->on('asset_class');
            $table->foreign('asset_region_id')->references('id')->on('asset_region');
        });

        Schema::create('instrument_holding', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('custodian_id');
            $table->unsignedSmallInteger('instrument_id');

            $table->foreign('custodian_id')->references('id')->on('custodian');
            $table->foreign('instrument_id')->references('id')->on('instrument');
        });

        Schema::create('cash_type', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('name', 10);
        });

        Schema::create('cash_holding', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedTinyInteger('custodian_id');
            $table->unsignedTinyInteger('currency_id');
            $table->unsignedTinyInteger('cash_type_id');

            $table->foreign('custodian_id')->references('id')->on('custodian');
            $table->foreign('currency_id')->references('id')->on('currency');
            $table->foreign('cash_type_id')->references('id')->on('cash_type');
        });

        Schema::create('asset_holding', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->unsignedSmallInteger('holdable_id');
            $table->string('holdable_type', 20);
            $table->unsignedInteger('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_holding');
        Schema::dropIfExists('cash_holding');
        Schema::dropIfExists('cash_type');
        Schema::dropIfExists('instrument_holding');
        Schema::dropIfExists('instrument');
        Schema::dropIfExists('asset_region');
        Schema::dropIfExists('asset_class');
        Schema::dropIfExists('currency');
        Schema::dropIfExists('custodian');
    }
};
