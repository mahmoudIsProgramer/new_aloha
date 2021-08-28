<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryFormRequest extends FormRequest
{
  public $rules = [
    'price' => 'required|integer',
    // 'fast_price' => 'required|integer|gt:slow_price',
    'city_id' => 'required|exists:cities,id',
    // 'state_id' => 'required|exists:states,id',
  ];

  public function authorize()
  {
    return true;
  }
  public function rules()
  {
    if ($this->isMethod('post')) {
      return $this->createRules();
    } elseif ($this->isMethod('put')) {
      return $this->updateRules();
    }
  }

  public function createRules()
  {

    $this->rules += [

    ];

    return $this->rules;
  }

  public function updateRules()
  {

    // $product =$this->route('product');

    $this->rules += [

    ];

    return $this->rules;
  }
}
