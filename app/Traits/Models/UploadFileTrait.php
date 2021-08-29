<?php

namespace App\Traits\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

trait UploadFileTrait
{

  function DeleteImage($DeleteFileWithName)
  {
    if (file_exists($DeleteFileWithName)) {
      \File::delete($DeleteFileWithName);
    }
  }

  #upload image
  function uploadImages($req, $path, $deleteOldImage, $meta = null)
  {
    // delete old image
    if ($deleteOldImage != '' && $deleteOldImage != 'default.png') {
      $this->DeleteImage(public_path('uploads/' . $path . $deleteOldImage));
    } //end of inner if

    if (isset($meta['optimize'])  && $meta['optimize'] == "no") {

      Log::info('not compressed ');
      $imageName = time() . '.' . $req->getClientOriginalExtension();

      $req->move(public_path('uploads/' . $path), $imageName);
      return $imageName;
    }

    Log::info('compressed ');

    Image::make($req)
      ->resize(300, null, function ($constraint) {
        $constraint->aspectRatio();
      })
      ->save(public_path('uploads/' . $path . $req->hashName()));
    return   $req->hashName();
  }

  // #multiple upload image
  function MultipleUploadImages($requests, $path)
  {

    $data = [];
    foreach ($requests as  $attach) {

      Image::make($attach)
        // ->resize(630, null, function ($constraint) {
        //   $constraint->aspectRatio();
        // })
        ->save(public_path('uploads/' . $path . $attach->hashName()));
      $data[] = $attach->hashName();


      // $fileName = time().rand(1,100).'.'.$attach->getClientOriginalExtension();

      // $attach->move( public_path('uploads/'.$path ) , $fileName );

      // $data[] = $fileName;
    }
    return $data;
  }


  // delete main image for model
  function removeImage($imageName, $path)
  {

    if ($imageName != 'cat.jpeg') {
      $DeleteFileWithName = public_path('uploads/' . $path . '/' . $imageName);

      if (file_exists($DeleteFileWithName) && $imageName != 'default.png') {
        File::delete($DeleteFileWithName);
      }
    } //end of inner if


  }
}
