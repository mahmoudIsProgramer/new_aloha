<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;

class FavoirteFormRequest extends BaseRequest
{

  public $rules = []; // end rules
  protected $errorBag = 'favoirte';

  public function authorize()
  {

    return true;
  }
  public function rules()
  {



    // rall();
    $this->rules+=[
      'product_id' => ['bail','required', 'exists:products,id'],
    ];
    return $this->rules;
  }
}
