<?php

namespace App\Traits\Models;

use App\Models\Customer;


trait CustomerTrait
{
  use UploadFileTrait;

  public function getRequestData()
  {

    $request_data = request()->except(['location', 'parameters', 'password', 'password_confirmation', 'address', 'image',]);
    return $request_data;
  }

  public function insertCustomer($request)
  {
    $request_data = $this->getRequestData();

    if ($request->image) {
      $request_data['image'] = $this->uploadImages($request->image, 'customers/', '');
    } //end of if

    $request_data['password'] = bcrypt($request->password);

    $customer = Customer::create($request_data);

    return $customer;
  }

  public function updateCustomer($customer, $request)
  {
    $request_data = $this->getRequestData();
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'customers/', $customer->image);
    } //end of if
    $customer->update($request_data);

    return true;
  }

  public function destroyCustomer($customer)
  {
    $this->removeImage($customer->image, 'customers');

    $customer->delete();

    return true;
  }
}
