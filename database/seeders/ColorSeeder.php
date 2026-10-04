<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create([
            'id'=>"1",
            'name'=>'Green',
            'slug'=>'green',
            'status'=>1
        ]);
        Color::create([
            'id'=>"2",
            'name'=>'Black',
            'slug'=>'black',
            'status'=>1
        ]);
        Color::create([
            'id'=>"3",
            'name'=>'White',
            'slug'=>'white',
            'status'=>1
        ]);
        Color::create([
            'id'=>"4",
            'name'=>'Pink',
            'slug'=>'pink',
            'status'=>1
        ]);
        Color::create([
            'id'=>"5",
            'name'=>'Blue',
            'slug'=>'blue',
            'status'=>1
        ]);
        Color::create([
            'id'=>"6",
            'name'=>'Orange',
            'slug'=>'orange',
            'status'=>1
        ]);
        Color::create([
            'id'=>"7",
            'name'=>'Red',
            'slug'=>'red',
            'status'=>1
        ]);
        Color::create([
            'id'=>"8",
            'name'=>'Lavender blush',
            'slug'=>'lavenderblush',
            'status'=>1
        ]);
        Color::create([
            'id'=>"9",
            'name'=>'Yellow',
            'slug'=>'yellow',
            'status'=>1
        ]);
        Color::create([
            'id'=>"10",
            'name'=>'Purple',
            'slug'=>'purple',
            'status'=>1
        ]);
    }
}
