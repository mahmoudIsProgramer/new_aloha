<?php

namespace App\Traits\Models;

use App\Models\Option;


trait OptionTrait
{
  use UploadFileTrait;

  public function insertOption($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $request_data['image'] = $this->uploadImages($request->image, 'options/', '');
    } //end of if

    $option = Option::create($request_data);

    return true;
  }

  public function updateOption($option, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'options/', $option->image);
    } //end of if

    $option->update($request_data);

    return true;
  }

  public function destroyOption($option)
  {

    $option->delete();

    return true;
  }
}
