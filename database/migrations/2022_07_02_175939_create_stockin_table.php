<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stockin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name',100);
            $table->float('quantity')->default('0.00');
            $table->string('product_unit',100);
            $table->float('cost_value')->default('0.00');
            $table->integer('done_by')->default('0');
            $table->float('total_amount')->default('0.00');
            $table->text('note');
            $table->string('status',100);
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
        Schema::dropIfExists('stockin');
    }
}
