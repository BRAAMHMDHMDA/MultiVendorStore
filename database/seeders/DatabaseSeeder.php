<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\User::factory(30)->create();
        $this->call([
        CategorySeeder::class,
        ]);

        Brand::create([
        'name' => 'HP',
        'slug' => 'hp',
    ]);
        Brand::create([
            'name' => 'Samsung',
            'slug' => 'samsung',
        ]);
        Brand::create([
            'name' => 'Apple',
            'slug' => 'apple',
        ]);
        Brand::create([
            'name' => 'Lenovo',
            'slug' => 'lenovo',
        ]);

        Tag::create([
            'name' => '#tag1',
            'slug' => 'tag1',
        ]);
        Tag::create([
            'name' => '#tag2',
            'slug' => 'tag2',
        ]);
        Tag::create([
            'name' => '#tag3',
            'slug' => 'tag3',
        ]);
        Tag::create([
            'name' => '#tag4',
            'slug' => 'tag4',
        ]);

        Store::factory(5)->create();

//      Category::factory(10)->create();

        Product::factory(100)->create();
    }
}
