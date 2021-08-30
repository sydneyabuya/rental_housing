<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasesTable extends Migration
{
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('paid', 15, 2)->nullable();
            $table->datetime('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
