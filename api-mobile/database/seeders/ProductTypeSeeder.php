<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('product_types')->insert([
            ['Id' => 'TYPE20220106001', 'Name' => 'DONUT',  'Image' => 'donut.jpg','Status' => 1],
            ['Id' => 'TYPE20220106002', 'Name' => 'CUPCAKE',  'Image' => 'cupcake.jpg','Status' => 1],
            ['Id' => 'TYPE20220106003', 'Name' => 'MOCHI',  'Image' => 'mochi.jpg','Status' => 1],
            ['Id' => 'TYPE20220106004', 'Name' => 'GATO',  'Image' => 'gato.jpg','Status' => 1],
        ]);
    }
}
