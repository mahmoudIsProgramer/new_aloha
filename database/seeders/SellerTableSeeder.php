<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $customer = Seller::create([
      'full_name' => "seller xyz",
      'email' => "seller@g.com",
      'gender' => "male",
      'company_name' => "xyz",
      'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);
  }
}
