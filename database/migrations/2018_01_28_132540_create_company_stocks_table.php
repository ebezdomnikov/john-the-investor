<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_stocks', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('company_id')->unsigned();
            $table->integer('stock_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('stock_id')->references('id')->on('stocks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_stocks');
    }
}
