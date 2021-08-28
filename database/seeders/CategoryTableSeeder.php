<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $category = Category::create([
      'ar' => ['name' => 'mobiles'],
      'en' => ['name' => 'mobiles'],
      // 'show_on_home_page' => rand(0, 1),
      'menu' => 1,
    ]);

    $subcategory = Subcategory::create([
      'category_id' => $category->id,
      'ar' => ['name' => 'mobiles phones'],
      'en' => ['name' => 'mobiles phones'],
    ]);

    $subsubcategory = Subsubcategory::create([
      'subcategory_id' => $subcategory->id,
      'ar' => ['name' => 'iphone'],
      'en' => ['name' => 'oppo'],
    ]);
  }
}
