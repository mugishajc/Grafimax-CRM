<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('job_name');
            $table->string('date');
            $table->string('client');
            $table->string('tel');
            $table->string('item_description');
            $table->string('item_size');
            $table->string('item_quantity');
            $table->string('received_by');
            $table->string('performed_by');
            $table->string('item_price');
            $table->string('total_price');
            $table->string('job_status');
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
