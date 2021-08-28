<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckWalletCharged implements Rule
{
  /**
   * Create a new rule instance.
   * $type :  check all tables except  type(table)
   * @return void
   */

  protected $payment_method = '';
  protected $customer = '';
  protected $amount = '';

  public function __construct($payment_method, $customer, $amount)
  {
    $this->payment_method = $payment_method;
    $this->customer = $customer;
    $this->amount = $amount;
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

    if ($this->payment_method == 'wallet' && $this->customer->wallet < $this->amount) {
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
    return __('site.Please chareg wallet current balance:', ['balance' => $this->customer->wallet]);
  }
}
