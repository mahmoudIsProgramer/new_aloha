<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

  use AuthenticatesUsers;

  protected $redirectTo = '/dashboard/index';

  public function logout(Request $request)
  {
    LogoutAllGuards();
    return redirect('login');
  }

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }
}
