<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkordersTable extends Migration
{
    public function up()
    {
        Schema::table('workorders', function (Blueprint $table) {
            $table->unsignedBigInteger('vendor_id');
            $table->foreign('vendor_id', 'vendor_fk_4748149')->references('id')->on('vendors');
            $table->unsignedBigInteger('vendor_spec_id')->nullable();
            $table->foreign('vendor_spec_id', 'vendor_spec_fk_4748150')->references('id')->on('vendors');
            $table->unsignedBigInteger('details_id');
            $table->foreign('details_id', 'details_fk_4748151')->references('id')->on('maintenances');
        });
    }
}
