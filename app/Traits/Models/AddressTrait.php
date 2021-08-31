<?php

namespace App\Traits\Models;

use App\Models\Address;

trait AddressTrait
{
  use UploadFileTrait;

  public function insertAddress($request)
  {
    $request_data = $request->except(['parameters']);
    $customer = getCustomer();
    $customer->addresses()->create($request_data);
    // $address = Address::create($request_data);

    return true;
  }

  public function updateAddress($address, $request)
  {
    $request_data = $request->except(['parameters',]);

    $address->update($request_data);

    return true;
  }

  public function destroyAddress($address)
  {

    $address->delete();

    return true;
  }
}
