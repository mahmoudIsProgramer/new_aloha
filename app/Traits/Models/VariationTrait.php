<?php

namespace App\Traits\Models;

use App\Models\Variation;


trait VariationTrait
{
  use UploadFileTrait;

  public function insertVariation($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $request_data['image'] = $this->uploadImages($request->image, 'variations/', '');
    } //end of if

    $variation = Variation::create($request_data);

    return true;
  }

  public function updateVariation($variation, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'variations/', $variation->image);
    } //end of if

    $variation->update($request_data);

    return true;
  }

  public function destroyVariation($variation)
  {

    $variation->delete();

    return true;
  }
}
