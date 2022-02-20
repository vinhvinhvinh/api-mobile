<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            ['Id' => 'CAKE20220106001', 'Name' => 'Bánh donut truyền thống', 'Price' => 20000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => '1.png', 'ProductTypeId' => 'TYPE20220106001', 'Description' => '500g bột mì, 201 ml sữa tươi, 100g đường cát trắng, 20g sữa bột, 7g men nở, 3g muối, 1 trứng gà, 35g bơ chảy, Dầu ăn, 200g chocolate', 'Status' => 1],
            ['Id' => 'CAKE20220106002', 'Name' => 'Bánh CupCake Chocolate', 'Price' => 25000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => 'arivals-2.jpg', 'ProductTypeId' => 'TYPE20220106002', 'Description' => '200g bột bánh, 2,5g muối, 2g bột nở, 1,25g baking soda,115g dâu tây nghiền mịn, 57g buttermilk, 225g đường, 28g bơ nhạt để ở nhiệt độ phòng, 71ml dầu thực vật, 1 quả trứng lớn để ở nhiệt độ phòng, 2 lòng đỏ trứng lớn, để ở nhiệt độ phòng, 1 – 2 giọt màu thực phẩm (đỏ)', 'Status' => 1],
            ['Id' => 'CAKE20220106003', 'Name' => 'Bánh gato dâu tây', 'Price' => 350000, 'Stock' => 5, 'Date' => '2020-01-06',  'Image' => 'c-feature-6.jpg', 'ProductTypeId' => 'TYPE20220106004', 'Description' => '30gr: bột trà xanh nguyên chất, 60gr: bột mì, 10ml nước cốt chanh tươi, 120gr:đường, 2gr: muối, 5 quả trứng gà, 500ml sữa tươi không đường, 20gr bơ nhạt, 100ml Kem tươi', 'Status' => 1],
            ['Id' => 'CAKE20220106004', 'Name' => 'Bánh Mochi đậu đỏ', 'Price' => 20000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => '1.png', 'ProductTypeId' => 'TYPE20220106003', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],
            ['Id' => 'CAKE20220106005', 'Name' => 'Bánh donut truyền thống', 'Price' => 20000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => '1.png', 'ProductTypeId' => 'TYPE20220106001', 'Description' => '500g bột mì, 201 ml sữa tươi, 100g đường cát trắng, 20g sữa bột, 7g men nở, 3g muối, 1 trứng gà, 35g bơ chảy, Dầu ăn, 200g chocolate', 'Status' => 1],
            ['Id' => 'CAKE20220106006', 'Name' => 'Bánh CupCake Dâu Tây', 'Price' => 25000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => 'c-feature-9.jpg', 'ProductTypeId' => 'TYPE20220106002', 'Description' => '200g bột bánh, 2,5g muối, 2g bột nở, 1,25g baking soda,115g dâu tây nghiền mịn, 57g buttermilk, 225g đường, 28g bơ nhạt để ở nhiệt độ phòng, 71ml dầu thực vật, 1 quả trứng lớn để ở nhiệt độ phòng, 2 lòng đỏ trứng lớn, để ở nhiệt độ phòng, 1 – 2 giọt màu thực phẩm (đỏ)', 'Status' => 1],
            ['Id' => 'CAKE20220106007', 'Name' => 'Bánh gato chocolate', 'Price' => 350000, 'Stock' => 5, 'Date' => '2020-01-06',  'Image' => 'c-feature-5.jpg', 'ProductTypeId' => 'TYPE20220106004', 'Description' => '30gr: bột trà xanh nguyên chất, 60gr: bột mì, 10ml nước cốt chanh tươi, 120gr:đường, 2gr: muối, 5 quả trứng gà, 500ml sữa tươi không đường, 20gr bơ nhạt, 100ml Kem tươi', 'Status' => 1],
            ['Id' => 'CAKE20220106008', 'Name' => 'Bánh Mochi đậu đỏ mini', 'Price' => 20000, 'Stock' => 30, 'Date' => '2020-01-06',  'Image' => '1.png', 'ProductTypeId' => 'TYPE20220106003', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],
            ['Id' => 'CAKE20220106009', 'Name' => 'Vera Sugar Smooth', 'Price' => 125000, 'Stock' => 30, 'Date' => '2022-01-12',  'Image' => 'service-5.png', 'ProductTypeId' => 'TYPE20220106003', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],
            ['Id' => 'CAKE20220106010', 'Name' => ' Galette des Rois', 'Price' => 24000, 'Stock' => 30, 'Date' => '2022-01-04',  'Image' => 'service-6.png', 'ProductTypeId' => 'TYPE20220106002', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],
            ['Id' => 'CAKE20220106012', 'Name' => 'Black Forest Cherry', 'Price' => 150000, 'Stock' => 30, 'Date' => '2022-01-01',  'Image' => 'bakery-3.jpg', 'ProductTypeId' => 'TYPE20220106001', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],
            ['Id' => 'CAKE20220106024', 'Name' => 'Vetkoek “Fat Cake”', 'Price' => 632000, 'Stock' => 30, 'Date' => '2022-01-10',  'Image' => 'portfolio-7.jpg', 'ProductTypeId' => 'TYPE20220106003', 'Description' => '100g bột nếp làm bánh , 150g đậu đỏ, 100ml nước lọc, 20g đường cát trắng, 20g bột năng, 300ml nước cốt dừa, 5g muối,5g vani', 'Status' => 1],

        ]);
    }
}