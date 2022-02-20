<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            ['Id' => 'COMMENT20220106001', 'user_id'=>'3', 'ProductId'=>'CAKE20220106001','Content'=>'Bánh ngon quá', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106002', 'user_id'=>'3', 'ProductId'=>'CAKE20220106002','Content'=>'Nên ăn thử một lần đi mọi người. Ngon lém', 'PostedDate'=>'2022-01-06', 'Status'=>1],

            ['Id' => 'COMMENT20220106003', 'user_id'=>'3', 'ProductId'=>'CAKE20220106004','Content'=>'Ngọt vừa, vị thanh', 'PostedDate'=>'2022-01-06' ,'Status'=>1],
            ['Id' => 'COMMENT20220106004', 'user_id'=>'4', 'ProductId'=>'CAKE20220106008','Content'=>'Rất ngon', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106005', 'user_id'=>'4', 'ProductId'=>'CAKE20220106002','Content'=>'Bánh ngon quá. Sẽ đặt thêm', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106006', 'user_id'=>'4', 'ProductId'=>'CAKE20220106003','Content'=>'Ăn một cái không đủ', 'PostedDate'=>'2022-01-06', 'Status'=>1],

            ['Id' => 'COMMENT20220106007', 'user_id'=>'5', 'ProductId'=>'CAKE20220106001','Content'=>'Bánh mềm, thơm', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106008', 'user_id'=>'5', 'ProductId'=>'CAKE20220106002','Content'=>'Very good!!!', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106009', 'user_id'=>'6', 'ProductId'=>'CAKE20220106005','Content'=>'Mỹ vị nhân gian', 'PostedDate'=>'2022-01-06', 'Status'=>1],
            ['Id' => 'COMMENT20220106010', 'user_id'=>'6', 'ProductId'=>'CAKE20220106005','Content'=>'Bánh ngon hơn nyc', 'PostedDate'=>'2022-01-06', 'Status'=>1],
       ]);
    }
}
