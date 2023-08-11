<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Category ::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Laptops & Computers',
            'slug' => 'laptops-computers',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Digital Cameras',
            'slug' => 'digital-cameras',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'TV & Video',
            'slug' => 'tv-video',
            'status' => 'active',
            'image_path' => '',
        ]);
        Category ::create([
            'name' => 'Cell Phones',
            'slug' => 'cell-phones',
            'status' => 'active',
            'image_path' => '',
        ]);
        Category ::create([
            'name' => 'Fashion',
            'slug' => 'fashion',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Accessories',
            'slug' => 'accessories',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Bags',
            'slug' => 'bags',
            'status' => 'active',
            'image_path' => '',

        ]);
        Category ::create([
            'name' => 'Shoes',
            'slug' => 'shoes',
            'status' => 'active',
            'image_path' => '',

        ]);
    }
}
