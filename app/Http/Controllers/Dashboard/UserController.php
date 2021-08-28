<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\User;
use App\Traits\RoleTrait;
use Illuminate\Http\Request;
use App\Rules\CheckEmailExist;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  use RoleTrait;
  public function __construct()
  {
    //create read update delete
    $this->middleware(['permission:read_users'])->only('index');
    $this->middleware(['permission:create_users'])->only('create');
    $this->middleware(['permission:update_users'])->only('edit');
    $this->middleware(['permission:delete_users'])->only('destroy');
  } //end of constructor

  public function index(Request $request)
  {

    $roles = $this->getRoles();

    $users = User::whenSearch(request()->search)
      ->whenRole(request()->role_id)
      ->with('roles')
      // ->whereNotIn('id', [1, 2, 3])
      ->paginate(20);

    return view('dashboard.users.index', compact('users', 'roles'));
  } //end of index

  public function create()
  {
    $roles = $this->getRoles();


    return view('dashboard.users.create', compact('roles'));
  } //end of create

  public function store(Request $request)
  {

    $request->validate([
      // 'role' => 'required|in:admin',
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => ['required', 'string', 'email', 'unique:users', new CheckEmailExist('users')],
      'image' => 'image',
      'password' => 'required|confirmed',
      // 'permissions' => 'required|min:1'
    ]);

    $request_data = $request->except(['password', 'password_confirmation', 'permissions', 'image']);
    $request_data['password'] = bcrypt($request->password);

    if ($request->image) {
      Image::make($request->image)
        ->resize(300, null, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save(public_path('uploads/user_images/' . $request->image->hashName()));
      $request_data['image'] = $request->image->hashName();
    } //end of if

    $user = User::create($request_data);
    $user->attachRoles([$request->role_id]);

    // $user->syncPermissions($request->permissions);

    session()->flash('success', __('site.added_successfully'));

    return redirect()->route('dashboard.users.index');
  } //end of store

  public function edit(User $user)
  {
    $roles = $this->getRoles();


    return view('dashboard.users.edit', compact('user', 'roles'));
  } //end of user

  public function edit_profile(User $user)
  {
    $roles = Role::get();

    return view('dashboard.users.edit_profile', compact('user'));
  } //end of user

  // update profile(normal user or admin ) or update the users(by the admin )
  public function update(Request $request, User $user)
  {

    $request->validate([
      'first_name' => 'required',
      'last_name' => 'required',
      // 'aboutUser' => 'nullable',
      'email' => ['required', Rule::unique('users')->ignore($user->id), new CheckEmailExist('users')],
      'image' => 'image',
      // 'permissions' => 'array',
      'password' => 'nullable|confirmed',
    ]);

    // dd($request->all());

    $request_data = $request->except(['permissions', 'image', 'password', 'password_confirmation']);

    if ($request->password) {
      $request_data['password'] = bcrypt($request->password);
    }
    if ($request->image) {

      if ($user->image != 'default.png') {

        Storage::disk('public_uploads')->delete('user_images/' . $user->image);
      } //end of inner if

      Image::make($request->image)
        ->resize(300, null, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save(public_path('uploads/user_images/' . $request->image->hashName()));

      $request_data['image'] = $request->image->hashName();
    } //end of external if

    $user->update($request_data);
    $user->syncRoles([$request->role_id]);

    // if($request->permissions){
    //     $user->syncPermissions($request->permissions);
    // }
    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.users.index');
  } //end of update

  public function destroy(User $user)
  {
    if (!$user) {
      return redirect()->back();
    }

    if ($user->image != 'default.png') {
      Storage::disk('public_uploads')->delete('user_images/' . $user->image);
    } //end of if

    $user->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.users.index');
  } //end of destroy

}//end of controller
