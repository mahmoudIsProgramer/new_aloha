<?php

namespace App\Http\Requests\Shared;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddressFormRequest extends FormRequest
{
  public $rules = [
    'city_id' => 'required|exists:cities,id',
    'state_id' => 'required|exists:states,id',
    'address' => 'required|string|max:255',
    'full_name' => 'required|string|max:255',

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

    return $this->rules;
  }

  public function updateRules()
  {

    $address = $this->route('address');

    $this->rules += [];


    return $this->rules;
  }
}
