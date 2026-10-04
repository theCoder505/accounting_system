<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::create([
            'id'=>"1",
            'name'=>'X',
            'slug'=>'x',
            'status'=>1
        ]);
        Size::create([
            'id'=>"2",
            'name'=>'L',
            'slug'=>'l',
            'status'=>1
        ]);
        Size::create([
            'id'=>"3",
            'name'=>'XL',
            'slug'=>'xl',
            'status'=>1
        ]);
        Size::create([
            'id'=>"4",
            'name'=>'XXL',
            'slug'=>'xxl',
            'status'=>1
        ]);
        Size::create([
            'id'=>"5",
            'name'=>'3XL',
            'slug'=>'3xl',
            'status'=>1
        ]);
        Size::create([
            'id'=>"6",
            'name'=>'S',
            'slug'=>'s',
            'status'=>1
        ]);
        Size::create([
            'id'=>"7",
            'name'=>'M',
            'slug'=>'m',
            'status'=>1
        ]);
    }
}
