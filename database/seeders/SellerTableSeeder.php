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
    $seller = Seller::create([
      'full_name' => "seller one",
      'email' => "seller@g.com",
      'gender' => "male",
      'company_name' => "one",
      // 'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);
    $seller = Seller::create([
      'full_name' => "seller two",
      'email' => "seller@g.com",
      'gender' => "male",
      'company_name' => "two",
      // 'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);
    $seller = Seller::create([
      'full_name' => "seller three",
      'email' => "seller@g.com",
      'gender' => "male",
      'company_name' => "three",
      // 'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);
    $seller = Seller::create([
      'full_name' => "seller four",
      'email' => "seller@g.com",
      'gender' => "male",
      'company_name' => "four",
      // 'state_id' => 1,
      'password' => bcrypt('123456'),
    ]);
  }
}
