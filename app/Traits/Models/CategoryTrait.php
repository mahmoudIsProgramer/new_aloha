<?php

namespace App\Traits\Models;

use App\Models\Category;


trait CategoryTrait
{
  use UploadFileTrait;

  public function insertCategory($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'categories/', '', $meta);
    } //end of if

    $category = Category::create($request_data);

    return true;
  }

  public function updateCategory($category, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'categories/', $category->image);
    } //end of if

    $category->update($request_data);

    return true;
  }

  public function destroyCategory($category)
  {

    $category->delete();

    return true;
  }
}
