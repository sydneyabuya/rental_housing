<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLeasesTable extends Migration
{
    public function up()
    {
        Schema::table('leases', function (Blueprint $table) {
            $table->unsignedBigInteger('amount_invoiced_id');
            $table->foreign('amount_invoiced_id', 'amount_invoiced_fk_4747384')->references('id')->on('invoices');
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id', 'property_fk_4747491')->references('id')->on('properties');
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id', 'unit_fk_4747492')->references('id')->on('units');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_4747788')->references('id')->on('units');
        });
    }
}
