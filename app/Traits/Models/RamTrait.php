<?php

namespace App\Traits\Models;

use App\Models\Ram;


trait RamTrait
{
  use UploadFileTrait;

  public function insertRam($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'rams/', '', $meta);
    } //end of if

    $ram = Ram::create($request_data);

    return true;
  }

  public function updateRam($ram, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'rams/', $ram->image);
    } //end of if

    $ram->update($request_data);

    return true;
  }

  public function destroyRam($ram)
  {

    $ram->delete();

    return true;
  }
}
