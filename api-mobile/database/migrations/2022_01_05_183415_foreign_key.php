<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Khóa ngoại của invoices
        // là AccountId
        Schema::table('invoices', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        //Khóa ngoại trong Comment
        //là AccountId và ProductId
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ProductId')->references('Id')->on('products');
        });

        //Khóa ngoại trong invoice_detail
        //là InvoiceId và ProductId
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->foreign('InvoiceId')->references('Id')->on('invoices');
            $table->foreign('ProductId')->references('Id')->on('products');
        });

        //Khóa ngoại trong favorite
        //là AccountId và ProductId
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ProductId')->references('Id')->on('products');
        });

        //Khóa ngoại trong Product
        //là ProductTypeId
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('ProductTypeId')->references('Id')->on('product_types');
        });

        //Khóa ngoại trong Cart
        //là AccountId và ProductId
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ProductId')->references('Id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}