<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $models = ['Slider 1' => 'سليدر 1', 'Slidere 2' => 'سليدر 2'];
    foreach ($models as $key => $value) {
      Slider::create([
        'image' => rand(1, 4) . '.jpg',
        'ar' => ['title' => $value],
        'en' => ['title' => $key],
      ]);
    }
  }
}
