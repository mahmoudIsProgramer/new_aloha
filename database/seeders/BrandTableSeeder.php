<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $models = ['Brand 1' => 'علامه تجاريه 1', 'Brand 2' => 'علامه تجاريه 2'];
    for ($i = 1; $i <= 2; $i++) {
      Brand::create([
        'ar' => ['name' => 'Brand ' . $i],
        'en' => ['name' => 'علامه تجاريه  ' . $i],
      ]);
    }
  }
}
