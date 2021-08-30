<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('phone');
            $table->unsignedBigInteger('vendor_id');
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendor')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'vendor_id','phone']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('worders');
    }
}
