<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id'=>"1",
            'name'=>"Health & Beauty",
            'slug'=>'heath-and0beauty',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Category::create([
            'id'=>"2",
            'name'=>"Men's Fashion",
            'slug'=>'mens-fashion',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Category::create([
            'id'=>"3",
            'name'=>"Women's Fashion",
            'slug'=>'Women-fashion',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Category::create([
            'id'=>"4",
            'name'=>'Electronic',
            'slug'=>'electronic',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Category::create([
            'id'=>"5",
            'name'=>'Home & Lifestyle',
            'slug'=>'home-and-lifestyle',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' =>'https://via.placeholder.com/800x500',
            'status'=>1
        ]);
        Category::create([
            'id'=>"6",
            'name'=>'Watches & Accessories',
            'slug'=>'watches-and-accessories',
            'parent_id'=>'0',
            'image' => 'https://via.placeholder.com/150',
            'meta_image' => 'https://via.placeholder.com/800x500',
            'status'=>1
        ]);


    }
}
