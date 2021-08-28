<?php

namespace App\Traits\Models;

use App\Models\Type;


trait TypeTrait
{
  use UploadFileTrait;

  public function insertType($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'types/', '', $meta);
    } //end of if

    $type = Type::create($request_data);

    return true;
  }

  public function updateType($type, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'types/', $type->image);
    } //end of if

    $type->update($request_data);

    return true;
  }

  public function destroyType($type)
  {

    $type->delete();

    return true;
  }
}
