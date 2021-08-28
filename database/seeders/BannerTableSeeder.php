<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Banner::create([
      'ar' => ['title' => '', 'description' => ''],
      'en' => ['title' => '', 'description' => ''],
      'link' => '',
      'bannerLocation' => 'home_page_1',
      'status' => 1,
      'image' => 'default.png',
    ]);
    Banner::create([
      'ar' => ['title' => '', 'description' => ''],
      'en' => ['title' => '', 'description' => ''],
      'link' => '',
      'bannerLocation' => 'home_page_2',
      'status' => 1,
      'image' => 'default.png',
    ]);
    Banner::create([
      'ar' => ['title' => '', 'description' => ''],
      'en' => ['title' => '', 'description' => ''],
      'link' => '',
      'bannerLocation' => 'home_page_3',
      'status' => 1,
      'image' => 'default.png',
    ]);
    Banner::create([
      'ar' => ['title' => '', 'description' => ''],
      'en' => ['title' => '', 'description' => ''],
      'link' => '',
      'bannerLocation' => 'products_page',
      'status' => 1,
      'image' => 'default.png',
    ]);
  }
}
