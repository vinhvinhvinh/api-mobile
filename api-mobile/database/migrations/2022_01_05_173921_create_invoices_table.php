<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->string('Id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->dateTime('IssueDate');
            $table->integer('Total');
            $table->string('PhoneShipping');
            $table->string('ShippingAddress');
            $table->integer('Discount');
            // foreign key
            $table->unsignedBigInteger('order_statuses_id');
            $table->unsignedBigInteger('payments_id');
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
        Schema::dropIfExists('invoices');
    }
}