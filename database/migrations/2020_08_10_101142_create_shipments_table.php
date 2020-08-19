<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('rider_id')->nullable();
            $table->string('status')->nullable();
            $table->string('shipmentId')->unique();
            $table->decimal('deliveryFee', 20, 2);
            $table->decimal('total', 20, 2)->nullable();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('dialed_rider_id')->nullable();
            $table->unsignedInteger('dialed_to_nearby_riders')->default(0);
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dialed_rider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
