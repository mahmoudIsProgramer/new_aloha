<?php

namespace App\Rules;

use App\Models\ProductSeller;
use Illuminate\Contracts\Validation\Rule;

class CheckProductStock implements Rule
{
  /**
   * Create a new rule instance.
   * $type :  check all tables except  type(table)
   * @return void
   */

  public $productSeller = null;
  public function __construct()
  {
    $this->productSeller = ProductSeller::find(request('product_seller_id'));
    // dd($this->productSeller);
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

    if (request('qty') && request('qty') > $this->productSeller->stock) {
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
    return __('Available is:') . $this->productSeller->stock;
  }
}
