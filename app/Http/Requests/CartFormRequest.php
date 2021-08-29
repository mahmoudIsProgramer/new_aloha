<?php

namespace App\Http\Requests;

use App\Rules\CheckProductStock;
use App\Http\Requests\BaseRequest;

class CartFormRequest extends BaseRequest
{

  public $rules = []; // end rules
  // protected $errorBag = 'cart';

  public function authorize()
  {
    return true;
  }
  public function rules()
  {

    $this->rules += [
      'qty' => 'nullable|numeric', // will be 1 if not sended
      'product_seller_id' => ['required', 'exists:product_seller,id', new CheckProductStock()],
    ];
    return $this->rules;
  }
}
