<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use App\Models\Regoin;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $models = ['Egypt' => 'مصر', 'saudia' => 'السعوديه'];
    foreach ($models as $key => $value) {
      City::create([
        'ar' => ['name' => $value],
        'en' => ['name' => $key],
      ]);
    }

    $models = ['Cairo' => 'القاهره', 'Giza' => 'الجيزه'];
    foreach ($models as $key => $value) {
      State::create([
        'city_id' => 1,

        'ar' => ['name' => $value],
        'en' => ['name' => $key],
      ]);
    }

    $models = ['Fesal' => 'فيصل', 'mounuib' => 'المنيب'];
    foreach ($models as $key => $value) {
      Regoin::create([
        'state_id' => 1,
        'ar' => ['name' => $value],
        'en' => ['name' => $key],
      ]);
    }
  }
}
