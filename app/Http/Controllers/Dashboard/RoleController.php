<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Permission;
use App\Traits\RoleTrait;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleFormRquest;

class RoleController extends Controller
{

  use RoleTrait;
  public function __construct()
  {
    // $this->middleware('permission:read_roles')->only(['index']);
    // $this->middleware('permission:create_roles')->only(['create', 'store']);
    // $this->middleware('permission:update_roles')->only(['edit', 'update']);
    // $this->middleware('permission:delete_roles')->only(['destroy']);

  } // end of __construct

  public function index()
  {
    $roles = $this->getRoles();

    return view('dashboard.roles.index', compact('roles'));
  } // end of index

  public function create()
  {
    return view('dashboard.roles.create');
  } //end of create


  public function createPermissionIfNotExist($newPermissions)
  {

    $permissions = Permission::pluck('name')->toArray();

    $permissionsNotExists = array_diff($newPermissions, $permissions);

    foreach ($permissionsNotExists as $new) {

      Permission::create(['name' => $new]);
    }

    return true;
  }

  public function store(Request $request)
  {

    $request_data = $request->except(['permissions', 'image']);

    $this->createPermissionIfNotExist($request->permissions);

    $role = Role::create($request_data);

    $role->attachPermissions($request->permissions);

    session()->flash('success', 'Data added successfully');

    return redirect()->route('dashboard.roles.index');
  } //end of store

  public function edit(Role $role)
  {

    $role = $role->load('permissions');

    return view('dashboard.roles.edit', compact('role'));
  } //end of edit

  public function update(RoleFormRquest $request, Role $role)
  {

    $request_data = $request->except(['permissions', 'image']);

    $this->createPermissionIfNotExist($request->permissions);

    $role->update($request_data);

    $role->syncPermissions($request->permissions);

    session()->flash('success', 'Data updated successfully');
    return redirect()->route('dashboard.roles.index');
  } //end of update





  public function destroy(Role $role)
  {
    $role->delete();
    session()->flash('success', 'Data deleted successfully');
    return redirect()->route('dashboard.roles.index');
  } //end of destroy

}//end of controller
