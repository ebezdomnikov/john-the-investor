<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_prices', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('market_id')->unsigned();
            $table->integer('company_stock_id')->unsigned();
            $table->integer('value');
            $table->timestamps();
            $table->foreign('market_id')->references('id')->on('markets');
            $table->foreign('company_stock_id')->references('id')->on('company_stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market_prices');
    }
}
