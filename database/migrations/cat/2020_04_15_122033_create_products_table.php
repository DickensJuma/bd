<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedInteger('status')->default(1);
            $table->longText('description');
            $table->decimal('price', 12, 2);
            $table->string('quantity')->nullable();
            $table->unsignedBigInteger('uniqueId');
            $table->timestamps();

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                ->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('product_category')
                ->onDelete('cascade');

            $table->foreign('brand_id')->references('id')->on('brands')
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
        Schema::dropIfExists('products');
    }
}
