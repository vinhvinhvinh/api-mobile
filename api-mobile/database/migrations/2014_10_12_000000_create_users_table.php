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
            $table->string('Username');
            $table->string('Password');
            $table->string('Email');
            $table->string('Fullname');
            $table->string('Address1');
            $table->string('Address2');
            $table->string('Phone');
            $table->string('Avatar')->nullable();
            $table->boolean('IsAdmin');
            $table->string('otp')->nullable();
            $table->integer('Status');
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
