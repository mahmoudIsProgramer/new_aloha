<?php

namespace Database\Seeders;

use App\Models\Promocode;
use Illuminate\Database\Seeder;

class PromocodeTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $user2 = Promocode::create([
      'code' => 'asd',
      'status' => '1',
      'startDate' => '2020-06-1',
      'endDate' => '2020-07-20',
      'limit' => 100,
      'type' => "value",
      'discount_amount' => 10,
    ]);

    $user2 = Promocode::create([
      'code' => 'asden',
      'status' => '1',
      'startDate' => '2020-06-1',
      'endDate' => '2020-07-20',
      'limit' => 50,
      'type' => "value",
      'discount_amount' => 20,
    ]);
  }
}
