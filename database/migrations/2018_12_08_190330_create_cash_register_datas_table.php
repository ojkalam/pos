<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashRegisterDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_register_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cash_register_id');
            $table->dateTime('time_opened');
            $table->dateTime('time_closed')->nullable();
            $table->integer('total_sales_amount')->nullable();
            $table->integer('item_sold')->nullable();
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
        Schema::dropIfExists('cash_register_datas');
    }
}
