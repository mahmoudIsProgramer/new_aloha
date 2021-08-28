<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

trait RoleTrait
{

  public function getRoles()
  {
    return   Role::whereRoleNot(['test'])
      ->whenSearch(request()->search)
      ->with(['permissions'])
      ->withCount('users')
      ->paginate(20);
  }
}
