<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyUnitPivotTable extends Migration
{
    public function up()
    {
        Schema::create('property_unit', function (Blueprint $table) {
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id', 'unit_id_fk_4747461')->references('id')->on('units')->onDelete('cascade');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id', 'property_id_fk_4747461')->references('id')->on('properties')->onDelete('cascade');
        });
    }
}
