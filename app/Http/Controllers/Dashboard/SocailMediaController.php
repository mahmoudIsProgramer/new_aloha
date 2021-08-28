<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SocailMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocailMediaController extends Controller
{

  public function index()
  {
    $socails = SocailMedia::latest()->paginate(20);

    return view('dashboard.socails.index', compact('socails'));
  } //end of index

  public function create()
  {
    return view('dashboard.socails.create');
  }

  public function store(Request $request)
  {
    $rules = [
      // 'image' => 'required|'.validateImage(),
    ];

    $request->validate($rules);

    $request_data = $request->all();

    SocailMedia::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.socail.index');
  }


  public function edit($socails)
  {
    $socails = SocailMedia::find($socails);


    return view('dashboard.socails.edit', compact('socails'));
  }


  public function update(Request $request, $socails)
  {
    $socails = SocailMedia::find($socails);

    $socails->update($request->all());


    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->route('dashboard.socail.index');
  }

  public function destroy($socailMedia)
  {
    $socailMedia = SocailMedia::find($socailMedia);
    if (!$socailMedia) {
      return redirect()->back();
    }
    $socailMedia->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.socail.index');
  }
}
