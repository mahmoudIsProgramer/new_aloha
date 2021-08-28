<?php

namespace App\Traits\Models;

use App\Models\Color;


trait ColorTrait
{
  use UploadFileTrait;

  public function insertColor($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'colors/', '', $meta);
    } //end of if

    $color = Color::create($request_data);

    return true;
  }

  public function updateColor($color, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'colors/', $color->image);
    } //end of if

    $color->update($request_data);

    return true;
  }

  public function destroyColor($color)
  {

    $color->delete();

    return true;
  }
}
