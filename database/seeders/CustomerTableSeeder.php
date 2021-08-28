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

    // Cart::create(['customer_id'=>$customer->id]);

    // $customer = Customer::create([
    //     'full_name'=>"m1" ,
    //     'email'=>"m1@m.com",
    //     'gender'=>"male",
    //     'password'=>bcrypt('123456'),
    // ]);
    // Cart::create(['customer_id'=>$customer->id]);

  }
}
