<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('invoices')->insert([
            ['Id' => 'INVOICE20220106001', 'user_id' => '3', 'IssueDate' => '2020-01-05', 'Total' => 55000, 'ShippingAddress' => '930-996 Đ. Trần Hưng Đạo, Phường 7, Quận 5', 'PhoneShipping' => '0123456789', 'Discount' => 0, 'order_statuses_id' => 1, 'payments_id' => 1],
            ['Id' => 'INVOICE20220106002', 'user_id' => '4', 'IssueDate' => '2020-01-05', 'Total' => 20000, 'ShippingAddress' => '65, Huỳnh Thúc Kháng, quận 1', 'PhoneShipping' => '0178923456', 'Discount' => 0, 'order_statuses_id' => 1, 'payments_id' => 1],
            ['Id' => 'INVOICE20220106003', 'user_id' => '5', 'IssueDate' => '2020-01-05', 'Total' => 40000, 'ShippingAddress' => '119 An Bình, Phường 6, Quận 5', 'PhoneShipping' => '0678912345', 'Discount' => 0, 'order_statuses_id' => 1, 'payments_id' => 1],
            ['Id' => 'INVOICE20220106004', 'user_id' => '6', 'IssueDate' => '2020-01-05', 'Total' => 70000, 'ShippingAddress' => '175/16 Đ. Nguyễn Tri Phương, Phường 8', 'PhoneShipping' => '0912345678', 'Discount' => 0, 'order_statuses_id' => 1, 'payments_id' => 1],
            ['Id' => 'INVOICE20220106005', 'user_id' => '6', 'IssueDate' => '2020-01-05', 'Total' => 35000, 'ShippingAddress' => 'phường 7, Quận 10', 'PhoneShipping' => '0192345678', 'Discount' => 0, 'order_statuses_id' => 1, 'payments_id' => 1],

        ]);
    }
}