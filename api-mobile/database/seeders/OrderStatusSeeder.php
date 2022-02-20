<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_statuses')->insert([
            ['id' => 1, 'name' => 'Chờ xác nhận', 'status' => 1],
            ['id' => 2, 'name' => 'Đang giao', 'status' => 1],
            ['id' => 3, 'name' => 'Đã giao', 'status' => 1],
            ['id' => 4, 'name' => 'Đã hủy', 'status' => 1],

        ]);
    }
}