<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\SiteOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteOptionController extends Controller
{
  public function __construct()
  {

    //create read update delete
    $this->middleware(['permission:read_site_options'])->only('index');
    $this->middleware(['permission:create_site_options'])->only('create');
    $this->middleware(['permission:update_site_options'])->only('edit');
    $this->middleware(['permission:delete_site_options'])->only('destroy');
  } // end of constructor

  public function index()
  {
    $site_options = SiteOption::latest()->paginate(20);
    return view('dashboard.site_options.index', compact('site_options'));
  } //end of index

  public function create()
  {
    return view('dashboard.site_options.create');
    return abort(404); //redirct to page not found
  }

  public function store(Request $request)
  {
    return abort(404); //redirct to page not found
  }

  public function show(SiteOption $SiteOption)
  {
    return abort(404); //redirct to page not found
  }

  public function edit($site_options)
  {
    $site_option = SiteOption::find($site_options);
    // dd($site_options );
    return view('dashboard.site_options.edit', compact('site_option'));
  }

  public function update(Request $request, $site_options)
  {

    $site_options = SiteOption::find($site_options);

    $request->validate([
      'logo' => validateImage(),
      'icon' => validateImage(),
    ]);

    $request_data = $request->except(['logo', 'icon']);

    //logo  icon
    if ($request->logo) {
      $request_data['logo'] = uploadImages($request->logo, 'site_options/', $site_options->logo);
    } //end of external if

    //logo  icon
    if ($request->icon) {
      $request_data['icon'] = uploadImages($request->icon, 'site_options/', $site_options->icon);
    } //end of external if

    $site_options->update($request_data);

    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->back();
  }

  public function destroy(SiteOption $socailMedia)
  {
    return abort(404); // redirct to page not found
  }
}
