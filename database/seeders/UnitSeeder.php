<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'id'=>"1",
            'name'=>'Box',
            'slug'=>'box',
            'status'=>1
        ]);
        Unit::create([
            'id'=>"2",
            'name'=>'Gram',
            'slug'=>'gram',
            'status'=>1
        ]);
        Unit::create([
            'id'=>"3",
            'name'=>'Piece',
            'slug'=>'piece',
            'status'=>1
        ]);
        Unit::create([
            'id'=>"4",
            'name'=>'Kilo',
            'slug'=>'kilo',
            'status'=>1
        ]);
        Unit::create([
            'id'=>"5",
            'name'=>'Liter',
            'slug'=>'liter',
            'status'=>1
        ]);
        Unit::create([
            'id'=>"6",
            'name'=>'Pack',
            'slug'=>'pack',
            'status'=>1
        ]);
    }
}
