<?php

namespace Database\Seeders;

use App\Models\Ram;
use App\Models\Sim;
use App\Models\Size;
use App\Models\Type;
use App\Models\Color;
use App\Models\Capacity;
use App\Models\Material;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariationTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $colors = ['red', 'white', 'black'];

    foreach ($colors as $item) {

      $color = Color::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $sizes = ['s', 'l', 'm'];

    foreach ($sizes as $item) {

      $size = Size::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $sims = ['single', 'dual', 'triple'];

    foreach ($sims as $item) {

      $sim = Sim::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $rams = ['4 ram', '8 ram', '16 ram'];

    foreach ($rams as $item) {

      $ram = Ram::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $capacities = ['64', '128', '256'];

    foreach ($capacities as $item) {

      $capacity = Capacity::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $types = ['type 1', 'type 1', 'type 3'];

    foreach ($types as $item) {

      $type = Type::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

    $materials = ['coton', 'satan'];

    foreach ($materials as $item) {

      $material = Material::create([
        'ar' => ['title' => $item],
        'en' => ['title' => $item],
      ]);
    }
    ################################

  }
}
