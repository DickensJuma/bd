<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_code')->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('role');
            $table->string('phone');
            $table->string('county')->nullable();
            $table->decimal('longitude', 11,8)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->string('address')->nullable();
            $table->string('location_name')->nullable();
            $table->unsignedInteger('status')->default(0);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
