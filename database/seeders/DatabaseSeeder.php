<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'tag1',
            'slug' => 'tag1',
        ]);
        Tag::create([
            'name' => 'tag2',
            'slug' => 'tag2',
        ]);
        Tag::create([
            'name' => 'tag3',
            'slug' => 'tag3',
        ]);
        Tag::create([
            'name' => 'tag4',
            'slug' => 'tag4',
        ]);

        Store::factory(6)->create();

        Vendor::create([
            'name' => 'Vendor1',
            'email' => 'vendor1@store1.com',
            'username' => 'vendor1',
            'phone_number' => '009728478524',
            'image_path' => 'default.jpg',
            'store_id' => 1,
            'password'=>Hash::make('000000'),
        ]);
        Vendor::create([
            'name' => 'Vendor2',
            'email' => 'vendor2@store2.com',
            'username' => 'vendor2',
            'phone_number' => '009728246524',
            'image_path' => 'default.jpg',
            'store_id' => 2,
            'password'=>Hash::make('000000'),

        ]);
        Vendor::create([
            'name' => 'Vendor3',
            'email' => 'vendor3@store3.com',
            'username' => 'vendor3',
            'phone_number' => '009728148584',
            'image_path' => 'default.jpg',
            'store_id' => 3,
            'password'=>Hash::make('000000'),

        ]);
        Vendor::create([
            'name' => 'Vendor4',
            'email' => 'vendor4@store4.com',
            'username' => 'vendor4',
            'phone_number' => '009728348584',
            'image_path' => 'default.jpg',
            'store_id' => 4,
            'password'=>Hash::make('000000'),

        ]);
        Vendor::create([
            'name' => 'Vendor5',
            'email' => 'vendor5@store5.com',
            'username' => 'vendor5',
            'phone_number' => '009728488584',
            'image_path' => 'default.jpg',
            'store_id' => 5,
            'password'=>Hash::make('000000'),

        ]);
        Vendor::create([
            'name' => 'Vendor6',
            'email' => 'vendor6@store6.com',
            'username' => 'vendor6',
            'phone_number' => '009723338584',
            'image_path' => 'default.jpg',
            'store_id' => 6,
            'password'=>Hash::make('000000'),

        ]);
        Vendor::create([
            'name' => 'Vendor7',
            'email' => 'vendor7@store1.com',
            'username' => 'vendor7',
            'phone_number' => '009722448584',
            'image_path' => 'default.jpg',
            'store_id' => 1,
            'password'=>Hash::make('000000'),

        ]);

        Admin::create([
            'name' => 'admin1',
            'email' => 'admin1@admin.com',
            'username' => 'admin1',
            'phone_number' => '009723448524',
            'image_path' => 'default.jpg',
            'password'=>Hash::make('000000'),

        ]);
        Admin::create([
            'name' => 'admin2',
            'email' => 'admin2@admin.com',
            'username' => 'admin2',
            'phone_number' => '009721144524',
            'image_path' => 'default.jpg',
            'password'=>Hash::make('000'),

        ]);
        Admin::create([
            'name' => 'admin3',
            'email' => 'admin3@admin.com',
            'username' => 'admin3',
            'phone_number' => '009725544524',
            'image_path' => 'default.jpg',
            'password'=>Hash::make('000'),

        ]);
        User::create([
            'name' => 'user1',
            'email' => 'user1@user1.com',
            'phone_number' => '009738478524',
            'image_path' => 'default.jpg',
            'password'=>Hash::make('000000'),
        ]);
        Product::factory(50)->create();
    }
}
