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
      Category::create([
        'name' => 'Electronics',
        'slug' => 'electronics',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Laptops & Computers',
        'slug' => 'laptops-computers',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Digital Cameras',
        'slug' => 'digital-cameras',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'TV & Video',
        'slug' => 'tv-video',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Cell Phones',
        'slug' => 'cell-phones',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Fashion',
        'slug' => 'fashion',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Jewlery & Watches',
        'slug' => 'jewlery-watches',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Clothing',
        'slug' => 'clothing',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Accessories',
        'slug' => 'accessories',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Bags',
        'slug' => 'bags',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Shoes',
        'slug' => 'shoes',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Home & Garden',
        'slug' => 'home-garden',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Chairs',
        'slug' => 'chairs',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Tables',
        'slug' => 'tables',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Beds, Frames & Bases',
        'slug' => 'beds-frames-bases',
        'status' => 'active',
      ]);
      Category::create([
        'name' => 'Futons & Sofa Beds',
        'slug' => 'futons-sofa-beds',
        'status' => 'active',
      ]);
    }
}
