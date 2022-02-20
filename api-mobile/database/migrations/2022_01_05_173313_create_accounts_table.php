<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->string('Id')->primary();
            $table->string('Username');
            $table->string('Password');
            $table->string('Email');
            $table->string('Fullname');
            $table->string('Address1');
            $table->string('Address2');
            $table->string('Phone');
            $table->string('Avatar');
            $table->boolean('IsAdmin');
            $table->integer('Status');
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
        Schema::dropIfExists('accounts');
    }
}