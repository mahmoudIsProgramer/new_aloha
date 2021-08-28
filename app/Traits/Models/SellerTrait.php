<?php

namespace App\Traits\Models;

use App\Models\Seller;

trait SellerTrait
{
  use UploadFileTrait;

  public function getRequestData()
  {
    $request_data = request()->except(['location', 'parameters', 'password', 'password_confirmation', 'address', 'image',]);
    return $request_data;
  }

  public function insertSeller($request)
  {
    $request_data = $this->getRequestData();

    if ($request->image) {
      $request_data['image'] = $this->uploadImages($request->image, 'sellers/', '');
    } //end of if

    $request_data['password'] = bcrypt($request->password);

    $seller = Seller::create($request_data);

    return $seller;
  }

  public function updateSeller($seller, $request)
  {
    $request_data = $this->getRequestData();
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'sellers/', $seller->image);
    } //end of if
    $seller->update($request_data);

    return true;
  }

  public function destroySeller($seller)
  {
    $this->removeImage($seller->image, 'sellers');

    $seller->delete();

    return true;
  }
 
}
