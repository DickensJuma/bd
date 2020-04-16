<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('orderNo');
            $table->unsignedBigInteger('customer_id');
            $table->decimal('total_price', 12, 2);
            $table->string('phone');
            $table->string('county')->nullable();
            $table->decimal('longitude', 11,8)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->string('address')->nullable()->nullable();
            $table->string('LocationName')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedInteger('paid')->default(0);
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('sub_total', 8, 2)->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('deliver');
            $table->foreign('coupon_id')->references('id')->on('coupons')
                ->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
