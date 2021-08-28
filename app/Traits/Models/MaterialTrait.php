<?php

namespace App\Traits\Models;

use App\Models\Material;


trait MaterialTrait
{
  use UploadFileTrait;

  public function insertMaterial($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'materials/', '', $meta);
    } //end of if

    $material = Material::create($request_data);

    return true;
  }

  public function updateMaterial($material, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'materials/', $material->image);
    } //end of if

    $material->update($request_data);

    return true;
  }

  public function destroyMaterial($material)
  {

    $material->delete();

    return true;
  }
}
