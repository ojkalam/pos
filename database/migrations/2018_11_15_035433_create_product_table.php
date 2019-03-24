<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('p_name', 255);
            $table->tinyInteger('category_id');
            $table->tinyInteger('brand_id')->nullable();
            $table->tinyInteger('tax_id')->nullable();
            $table->string('sku');
            $table->integer('stock_quantity');
            $table->integer('alert_quantity')->default(0);
            $table->integer('default_purchase_price');
            $table->integer('profit_percent')->nullable();
            $table->integer('sell_price_inc_tax');
            $table->string('p_image', 255)->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('products');
    }
}
