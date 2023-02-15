<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::insert(
        //     ['name' => 'Binh',
        //     'email' => 'abc@bb.cc',
        //     'password' => Hash::make('123123123'),
        //     'created_at' => now(),
        //     ]
        // );
        // \App\Models\Category::insert([
        //    [ 'name' => 'Smartphone'],
        //    [ 'name' => 'Laptop']
        // ]);

        $data = [];
        // for ($i=0;$i<10;$i++) {
        //     $x = $i + 1;
        //     $dataI =
        //         [
        //             'category_id' => 3,
        //             'name' => 'Samsung Tab' . $x,
        //             'description' => 'Samsung tab' . $x,
        //             'quantity'  => rand(5,20),
        //             'thumbnail' => '',
        //             'price' => rand(300,600),
        //             'created_at' => now(),
        //         ];


        //     array_push($data, $dataI);
        // }
        // \App\Models\Product::insert($data);
    }
}
