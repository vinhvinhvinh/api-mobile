<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('favorites')->insert([
            ['user_id' => '3', 'ProductId' => 'CAKE20220106001', 'Status' => 1],
            ['user_id' => '3', 'ProductId' => 'CAKE20220106002', 'Status' => 1],

            ['user_id' => '3', 'ProductId' => 'CAKE20220106004', 'Status' => 1],
            ['user_id' => '4', 'ProductId' => 'CAKE20220106008', 'Status' => 1],
            ['user_id' => '4', 'ProductId' => 'CAKE20220106002', 'Status' => 1],
            ['user_id' => '4', 'ProductId' => 'CAKE20220106003', 'Status' => 1],

            ['user_id' => '5', 'ProductId' => 'CAKE20220106001', 'Status' => 1],
            ['user_id' => '5', 'ProductId' => 'CAKE20220106002', 'Status' => 1],
            ['user_id' => '6', 'ProductId' => 'CAKE20220106005', 'Status' => 1],
            ['user_id' => '6', 'ProductId' => 'CAKE20220106005', 'Status' => 1],
        ]);
    }
}