<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Background;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BackgroundController extends Controller
{
  public function index(Request $request)
  {
    $backgrounds = Background::latest()->paginate(50);

    return view('dashboard.backgrounds.index', compact('backgrounds'));
  } //end of index


  public function create()
  {
    return view('dashboard.backgrounds.create');
  } //end of create

  public function store(Request $request)
  {
    $rules = [];

    $rules += [
      'image' => validateImage(),
    ];

    $request->validate($rules);
    $request_data = $request->all();

    if ($request->image) {

      $request_data['image'] = uploadImages($request->image, 'backgrounds/', '');
    } //end of if

    Background::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.backgrounds.index');
  } //end of store

  public function edit(Background $background)
  {

    return view('dashboard.backgrounds.edit', compact('background'));
  } //end of edit

  public function update(Request $request, Background $background)
  {
    $rules = [
      'image' =>  validateImage(),
    ];
    $request->validate($rules);

    $request_data = $request->except(['image']);
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'backgrounds/', $background->image);
      Storage::disk('public_uploads')->delete('backgrounds/' . $background->image);
    }  //end of if

    $background->update($request_data);
    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.backgrounds.index');
  } //end of update

}
