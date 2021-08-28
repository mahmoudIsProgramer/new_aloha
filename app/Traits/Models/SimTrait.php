<?php

namespace App\Traits\Models;

use App\Models\Sim;


trait SimTrait
{
  use UploadFileTrait;

  public function insertSim($request)
  {
    $request_data = $request->except(['parameters']);

    if ($request->image) {
      $meta['optimize'] = "yes";
      // dd($meta);
      $request_data['image'] = $this->uploadImages($request->image, 'sims/', '', $meta);
    } //end of if

    $sim = Sim::create($request_data);

    return true;
  }

  public function updateSim($sim, $request)
  {
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'sims/', $sim->image);
    } //end of if

    $sim->update($request_data);

    return true;
  }

  public function destroySim($sim)
  {

    $sim->delete();

    return true;
  }
}
