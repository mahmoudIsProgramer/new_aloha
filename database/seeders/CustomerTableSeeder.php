<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $customer = Customer::create([
      'full_name' => "m",
      'email' => "m@g.com",
      'gender' => "male",
      'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);

  }
}
