<?php

namespace App\Traits\Models;

use App\Models\Size;

trait SizeTrait
{
  use UploadFileTrait;

  public function insertSize($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'sizes/', '', $meta);
    } //end of if

    $size = Size::create($request_data);

    return true;
  }

  public function updateSize($size, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'sizes/', $size->image);
    } //end of if

    $size->update($request_data);

    return true;
  }

  public function destroySize($size)
  {

    $size->delete();

    return true;
  }
}
