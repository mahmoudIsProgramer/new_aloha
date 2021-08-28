<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

  public function run()
  {
    $this->call(LaratrustSeeder::class);
    $this->call(UsersTableSeeder::class);
    $this->call(CityTableSeeder::class);
    $this->call(StaticPageTableSeeder::class);
    $this->call(VariationTableSeeder::class);
    $this->call(CategoryTableSeeder::class);
    $this->call(BrandTableSeeder::class);
    $this->call(SellerTableSeeder::class);
    $this->call(BannerTableSeeder::class);
    // $this->call(SliderTableSeeder::class);
    // $this->call(ProductTableSeeder::class);
    // $this->call(CustomerTableSeeder::class);
    // $this->call(BlogTableSeeder::class);

  }
}
