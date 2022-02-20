<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('invoice_details')->insert([

            ['Id' => 1, 'InvoiceId' => 'INVOICE20220106001', 'ProductId' => 'CAKE20220106001', 'Quantity' => 1, 'Unitprice' => 20000, 'Intomoney' => 20000],
            ['Id' => 2, 'InvoiceId' => 'INVOICE20220106001', 'ProductId' => 'CAKE20220106003', 'Quantity' => 1, 'Unitprice' => 35000, 'Intomoney' => 35000],
            ['Id' => 3, 'InvoiceId' => 'INVOICE20220106002', 'ProductId' => 'CAKE20220106005', 'Quantity' => 1, 'Unitprice' => 20000, 'Intomoney' => 20000],
            ['Id' => 4, 'InvoiceId' => 'INVOICE20220106003', 'ProductId' => 'CAKE20220106008', 'Quantity' => 2, 'Unitprice' => 40000, 'Intomoney' => 40000],
            ['Id' => 5, 'InvoiceId' => 'INVOICE20220106004', 'ProductId' => 'CAKE20220106007', 'Quantity' => 2, 'Unitprice' => 70000, 'Intomoney' => 140000],
            ['Id' => 6, 'InvoiceId' => 'INVOICE20220106005', 'ProductId' => 'CAKE20220106003', 'Quantity' => 1, 'Unitprice' => 35000, 'Intomoney' => 35000],

        ]);
    }
}