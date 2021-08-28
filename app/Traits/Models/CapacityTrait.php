<?php

namespace App\Traits\Models;

use App\Models\Capacity;

trait CapacityTrait
{
  use UploadFileTrait;

  public function insertCapacity($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'storages/', '', $meta);
    } //end of if

    $storage = Capacity::create($request_data);

    return true;
  }

  public function updateCapacity($storage, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'storages/', $storage->image);
    } //end of if

    $storage->update($request_data);

    return true;
  }

  public function destroyCapacity($storage)
  {

    $storage->delete();

    return true;
  }
}
