<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'id'=>"1",
            'name'=>"Lotto",
            'slug'=>'lotto',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Brand::create([
            'id'=>"2",
            'name'=>"Fair & Lovely",
            'slug'=>'fair-and-lovely',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Brand::create([
            'id'=>"3",
            'name'=>"Samsung",
            'slug'=>'samsung',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Brand::create([
            'id'=>"4",
            'name'=>'LG',
            'slug'=>'lg',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Brand::create([
            'id'=>"5",
            'name'=>'HP',
            'slug'=>'hp',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' =>'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Brand::create([
            'id'=>"6",
            'name'=>'OPPO',
            'slug'=>'oppo',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
    }
}
