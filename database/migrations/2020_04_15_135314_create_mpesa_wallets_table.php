<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpesaWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_wallets', function (Blueprint $table) {
            $table->id();
            $table->string('trans_id')->unique();
            $table->integer('user_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('service_id');
            $table->string('phone');
            $table->string('amount');
            $table->string('receipt_number');
            $table->string('transaction_date');
            $table->timestamps();
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_wallets');
    }
}
