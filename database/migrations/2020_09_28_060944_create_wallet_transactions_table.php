<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rider_id');
            $table->decimal('amount', 20,2);
            $table->unsignedBigInteger('shipment_id')->nullable();
            $table->string('type');  // ride-complete, pay-out
            $table->decimal('wallet_balance', 20,2);
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('shipment_id')->references('id')->on('shipments')
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
        Schema::dropIfExists('wallet_transactions');
    }
}
