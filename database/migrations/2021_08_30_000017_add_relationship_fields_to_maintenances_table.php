<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMaintenancesTable extends Migration
{
    public function up()
    {
        Schema::table('maintenances', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_4748078')->references('id')->on('users');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id', 'property_fk_4753576')->references('id')->on('properties');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_4748079')->references('id')->on('units');
        });
    }
}
