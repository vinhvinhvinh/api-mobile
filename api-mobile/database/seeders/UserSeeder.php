<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['Username' => 'admin123',  'Password' => Hash::make('123456'), 'Email' => 'admin123@gmail.com', 'Fullname' => 'Admin thứ 1', 'Address1' => 'Gò vấp', 'Address2' => 'Bình Tân', 'Phone' => '0123456789', 'Avatar' => 'abc.jpg', 'IsAdmin' => true, 'Status' => 1],
            ['Username' => 'admin456',  'Password' => Hash::make('123456'), 'Email' => 'admin456@gmail.com', 'Fullname' => 'Admin thứ 2', 'Address1' => 'Thủ Đức', 'Address2' => 'Bình Tân', 'Phone' => '0123424124', 'Avatar' => 'abcdv.jpg', 'IsAdmin' => true, 'Status' => 1],
            ['Username' => 'admin789',  'Password' => Hash::make('123456'), 'Email' => 'admin789@gmail.com', 'Fullname' => 'Admin thứ 3', 'Address1' => 'Bình Chánh', 'Address2' => 'Quận 8', 'Phone' => '0122425524', 'Avatar' => 'abcdasv.jpg', 'IsAdmin' => true, 'Status' => 1],
            ['Username' => 'customer123',  'Password' => Hash::make('123456'), 'Email' => 'customer123@gmail.com', 'Fullname' => 'Vinh Nguyễn', 'Address1' => 'Gò vấp', 'Address2' => 'Bình Tân', 'Phone' => '0123421512', 'Avatar' => 'abc.jpg', 'IsAdmin' => false, 'Status' => 1],
            ['Username' => 'customer456',  'Password' => Hash::make('123456'), 'Email' => 'customer456@gmail.com', 'Fullname' => ' Bích Tiền', 'Address1' => 'Thủ Đức', 'Address2' => 'Bình Tân', 'Phone' => '0124334734', 'Avatar' => 'abcdv.jpg', 'IsAdmin' => false, 'Status' => 1],
            ['Username' => 'customer789',  'Password' => Hash::make('123456'), 'Email' => 'customer789@gmail.com', 'Fullname' => 'Thành Lễ', 'Address1' => 'Bình Chánh', 'Address2' => 'Quận 8', 'Phone' => '01224436437', 'Avatar' => 'abcdasv.jpg', 'IsAdmin' => false, 'Status' => 1],
        ]);
    }
}
