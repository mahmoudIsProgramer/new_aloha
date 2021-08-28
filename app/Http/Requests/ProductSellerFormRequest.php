<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSellerFormRequest extends FormRequest
{

  public $rules = [

    // 'product_id' => 'required|products:cities,id',
    'seller_id' => 'required|exists:sellers,id',
    'selling_price' => ['required', 'integer'],
    'discount' => ['nullable', 'integer', 'lt:selling_price'],
    'stock' => ['required', 'integer'],
    'status' => 'nullable',
    'seller_notes' => 'required',
    'sku' => 'required',
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
    $this->rules += [];
    return $this->rules;
  }
  public function updateRules()
  {
    $this->rules += [];
    return $this->rules;
  }
}
