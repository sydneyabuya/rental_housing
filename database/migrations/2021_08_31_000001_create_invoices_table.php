<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('billing_for');
            $table->decimal('amount', 15, 2);
            $table->datetime('due');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
