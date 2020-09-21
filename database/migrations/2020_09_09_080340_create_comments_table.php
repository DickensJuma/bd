<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderNo');
            $table->unsignedBigInteger('shipmentId');
            $table->unsignedBigInteger('userId');
            $table->string('comment');
            $table->string('status')->nullable();
            $table->timestamps();


            $table->foreign('orderNo')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('shipmentId')->references('id')->on('shipments')->onDelete('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
