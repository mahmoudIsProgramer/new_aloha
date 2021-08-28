<?php

namespace App\Rules;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class CustomerValidateOldPassword implements Rule
{
  /**
   * Create a new rule instance.
   * $type :  check all tables except  type(table)
   * @return void
   */


  public function __construct()
  {
  }

  /**
   * Determine if the validation rule passes.
   *
  * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {

    $customer = getCustomer();
    $credentials = ['email' => $customer->email, 'password' => request()->old_password];

    // login
    if (!Auth::guard('customer')->attempt($credentials)) {
      return false;
    }
    return true;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */

  public function message()
  {
    return __('site.Old Password Not Correct');
  }
}
