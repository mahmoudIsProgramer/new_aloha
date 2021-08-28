<?php

namespace App\Traits\Models;

use App\Models\Seller;

trait GetterTrait
{
  public function getSellers()
  {
    return  Seller::Active()->get();
  }
  public function allCustomers()
  {
    return Customer::Active()->get();
  }
}
