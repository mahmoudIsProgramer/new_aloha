<?php

namespace App\Rules;

use App\Product;
use Illuminate\Contracts\Validation\Rule;

class CheckProductStock implements Rule
{
  /**
   * Create a new rule instance.
   * $type :  check all tables except  type(table)
   * @return void
   */

  public $product = null;
  public function __construct()
  {
    $this->product = Product::find(request('product_id'));
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

    if (request('qty') && request('qty') > $this->product->stock) {
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
    return __('This Product Out Of Stock Available is:') . $this->product->stock;
  }
}
