<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationLeasePivotTable extends Migration
{
    public function up()
    {
        Schema::create('application_lease', function (Blueprint $table) {
            $table->unsignedBigInteger('lease_id');
            $table->foreign('lease_id', 'lease_id_fk_4747369')->references('id')->on('leases')->onDelete('cascade');
            $table->unsignedBigInteger('application_id');
            $table->foreign('application_id', 'application_id_fk_4747369')->references('id')->on('applications')->onDelete('cascade');
        });
    }
}
