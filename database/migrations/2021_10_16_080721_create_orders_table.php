<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('daily_sale_id');
            $table->unsignedBigInteger('inventory_id');
            $table->string('quantity');
            $table->string('amount');
            $table->string('total');
            $table->timestamps();

            $table->foreign('daily_sale_id')
                ->references('id')
                ->on('daily_sales');

            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
