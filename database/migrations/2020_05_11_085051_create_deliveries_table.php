<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Rider_id');
            $table->unsignedBigInteger('Customer_id');
            $table->unsignedBigInteger('Order_id');
            $table->foreign('Rider_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('Customer_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('Order_id')->references('id')->on('orders')
                ->onDelete('cascade');
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
        Schema::dropIfExists('deliveries');
    }
}
